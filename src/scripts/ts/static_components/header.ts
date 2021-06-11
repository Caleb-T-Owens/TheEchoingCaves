import $ from "jquery";

class Header {
  static init() {
    $(".header-item-container").on("mouseenter", this.onMouseOver);
    $(".header-item-container").on("mouseleave", this.onMouseLeave);
  }

  static onMouseOver() {
    $(this).addClass(".header-item-container-hovered");
  }

  static onMouseLeave() {
    $(this).removeClass(".header-item-contaioner-hovered");
  }
}

$(Header.init);
