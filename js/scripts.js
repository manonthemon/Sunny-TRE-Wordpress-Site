class Search {
  constructor() {
    this.openButton = document.querySelector(".search-trigger");
    this.closeButton = document.querySelector(".search-overlay__close");
    this.searchOverlay = document.querySelector(".search-overlay");
    this.searchField = document.getElementById("search-term");
    this.resultsDiv = document.querySelector(".search-overlay__results");
    this.isOverlayOpen = false;
    this.events();
    this.typingTimer;
    this.isSpinnerVisible = false;
    this.previousValue;
  }

  events() {
    this.openButton.addEventListener("click", () => this.openOverlay());
    this.closeButton.addEventListener("click", () => this.closeOverlay());
    document.addEventListener("keydown", (event) => this.handleKeyPress(event));
    this.searchField.addEventListener("keyup", () => this.typingLogic());
  }

  typingLogic() {
    if (this.searchField.value != this.previousValue) {
      clearTimeout(this.typingTimer);
      if (this.searchField.value) {
        if (!this.isSpinnerVisible) {
          this.resultsDiv.innerHTML = '<div class="spinner-loader"></div>';
          this.isSpinnerVisible = true;
        }
        this.typingTimer = setTimeout(() => {
          this.getResults(); // Arrow function maintains the correct 'this' context
        }, 2000);
      } else {
        this.resultsDiv.innerHTML = "";
        this.isSpinnerVisible = false;
      }
    }

    this.previousValue = this.searchField.value;
  }

  getResults() {
    this.resultsDiv.innerHTML = "Imagine real search results here";
    this.isSpinnerVisible = false;
  }

  handleKeyPress(event) {
    if (event.keyCode === 27 && this.isOverlayOpen) {
      this.closeOverlay();
    }
  }

  openOverlay() {
    this.searchOverlay.classList.add("search-overlay--active");
    document.querySelector("body").classList.add("body-no-scroll");
    this.isOverlayOpen = true;
  }

  closeOverlay() {
    this.searchOverlay.classList.remove("search-overlay--active");
    document.querySelector("body").classList.remove("body-no-scroll");
    this.isOverlayOpen = false;
  }
}

document.addEventListener("DOMContentLoaded", function () {
  var amazingSearch = new Search();
});
