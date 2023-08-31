class Search {
  constructor() {
    this.openButton = document.querySelector(".search-trigger");
    this.closeButton = document.querySelector(".search-overlay__close");
    this.searchOverlay = document.querySelector(".search-overlay");
    this.searchField =  document.getElementById("search-term")
    this.isOverlayOpen = false;
    this.events();
  }

  events() {
    this.openButton.addEventListener("click", () => this.openOverlay());
    this.closeButton.addEventListener("click", () => this.closeOverlay());
    document.addEventListener('keydown', (event) => this.handleKeyPress(event));
    this.searchField.addEventListener("keydown", this.typingLogic); 
  

  }


typingLogic() {
console.log("Typing")
}




  handleKeyPress(event) {
    if(event.keyCode === 27 && this.isOverlayOpen) {
      this.closeOverlay();
    }
  }

  openOverlay() {
    this.searchOverlay.classList.add("search-overlay--active");
    document.querySelector('body').classList.add("body-no-scroll");
    this.isOverlayOpen = true;
  }

  closeOverlay() {
    this.searchOverlay.classList.remove("search-overlay--active");
    document.querySelector('body').classList.remove("body-no-scroll");
    this.isOverlayOpen = false;
  }
}

document.addEventListener("DOMContentLoaded", function () {
  var amazingSearch = new Search();
});
