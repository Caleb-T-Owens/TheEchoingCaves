const fs = require("fs")

const promisify = (fn) => (...params) => new Promise((resolve) => fn(...params, (...resp) => resolve(resp)))

const readdir = promisify(fs.readdir)

async function getFileTree() {
	
}

async function processFiles() {
	const [err, files] = await readdir("./src/scripts/js/")
	console.log(files)
}

processFiles()

fs.watch("./src/scripts/js/", (eventType, fileName) => {

})
