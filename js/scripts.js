class Search {
  constructor() {
    console.log("Constructor called");
    this.openButton = document.querySelector(".search-trigger");
    this.closeButton = document.querySelector(".search-overlay__close");
    this.searchOverlay = document.querySelector(".search-overlay");
    this.events();
  }

  events() {
    console.log("Event listeners added");
    this.openButton.addEventListener("click", this.openOverlay.bind(this));
    this.closeButton.addEventListener("click", this.closeOverlay.bind(this));
  }

  openOverlay() {
    console.log("Open overlay clicked");
    this.searchOverlay.classList.add("search-overlay--active");
  }

  closeOverlay() {
    console.log("Close overlay clicked");
    this.searchOverlay.classList.remove("search-overlay--active");
  }
}

document.addEventListener("DOMContentLoaded", function () {
  console.log("DOM content loaded");

});

var amazingSearch = new Search();
