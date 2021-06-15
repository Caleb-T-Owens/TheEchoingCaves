const fs = require("fs");

const _mappings = JSON.parse(fs.readFileSync("./mappings.json").toString());
console.log(_mappings);
const mappings = [];

for (const mapping in _mappings) {
  mappings.push([
    new RegExp(
      "(?<=import .+ from [\", ', `])" + mapping + "(?=[\", ', `])",
      "g"
    ),
    _mappings[mapping],
  ]);
}

const promisify =
  (fn) =>
  (...params) =>
    new Promise((resolve) => fn(...params, (...resp) => resolve(resp)));

const readdir = promisify(fs.readdir);
const mkdir = promisify(fs.mkdir);
const rmdir = promisify(fs.rmdir);
const writeFile = promisify(fs.writeFile);
const readFile = promisify(fs.readFile);

async function getFileTree(dir = "") {
  const [, contents] = await readdir("./src/scripts/js/" + dir);

  const out = { files: [], dirs: {} };

  for (const file of contents) {
    if (file.includes(".")) {
      out.files.push(file);
    } else {
      out.dirs[file] = await getFileTree(file);
    }
  }

  return out;
}

async function buildOutput(tree, dir = "/", depth = 3) {
  await mkdir("./src/scripts/out" + dir);

  for (const file of tree.files) {
    const [, _contents] = await readFile("./src/scripts/js" + dir + file);

    if (file.endsWith(".js")) {
      let contents = _contents.toString();

      for (const mapping of mappings) {
        let tmp = "";
        while (contents !== tmp) {
          tmp = contents;
          contents = contents.replace(
            mapping[0],
            Array(depth)
              .fill("../")
              .reduce((a, b) => a + b) + mapping[1]
          );
        }
      }

      await writeFile("./src/scripts/out" + dir + file, contents);
    } else {
      await writeFile("./src/scripts/out" + dir + file, _contents);
    }
  }

  for (const directory in tree.dirs) {
    await buildOutput(tree.dirs[directory], dir + directory + "/", depth + 1);
  }
}

async function processFiles() {
  const files = await getFileTree();
  console.log(files);

  await rmdir("./src/scripts/out");
  await buildOutput(files);
}

processFiles();

fs.watch("./src/scripts/js/", (eventType, fileName) => {
  processFiles();
});
