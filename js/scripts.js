class Search {
  constructor() {
    this.addSearchHTML();
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
        }, 500);
      } else {
        this.resultsDiv.innerHTML = "";
        this.isSpinnerVisible = false;
      }
    }
  
    this.previousValue = this.searchField.value;
  }

  getResults() {
    fetch(sunnyData.root_url + '/wp-json/wp/v2/posts?search=' + this.searchField.value)
      .then(response => response.json())
      .then(posts => {
        this.resultsDiv.innerHTML = `
          <h2 class="search-overlay__section-title">General Information</h2>
          ${posts.length ? '<ul class="link=list min-list">' : '<p>No general information matches that search.</p>'}
          ${posts.map(item => `<li><a href="${item.link}">${item.title.rendered}</a></li>`).join('')}
          ${posts.length ? '</ul>' : ''}
        `;
      })
      .catch(error => {
        console.error('Error fetching data:', error);
        this.isSpinnerVisible = false;
      });
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

  addSearchHTML() {
    document.querySelector("body").insertAdjacentHTML("beforeend", `
      <div class="search-overlay">
        <div class="search-overlay__top">
          <div class="container">
            <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
            <input type="text" class="search-term" placeholder="What are you looking for?" id="search-term">
            <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
          </div>
        </div>
        <div class="container">
          <div class="search-overlay__results"></div>
        </div>
      </div>
    `);
  }
}

document.addEventListener("DOMContentLoaded", function () {
  var amazingSearch = new Search();
});
