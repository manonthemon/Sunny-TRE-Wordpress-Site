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
    const searchQuery = this.searchField.value;
    const postsEndpoint = `${sunnyData.root_url}/wp-json/wp/v2/posts?search=${searchQuery}`;
    const pagesEndpoint = `${sunnyData.root_url}/wp-json/wp/v2/pages?search=${searchQuery}`;
  
    // Fetch posts and pages data concurrently using Promise.all
    Promise.all([fetch(postsEndpoint), fetch(pagesEndpoint)])
      .then(([postsResponse, pagesResponse]) => {
        return Promise.all([postsResponse.json(), pagesResponse.json()]);
      })
      .then(([posts, pages]) => {
        // Combine posts and pages results
        const combinedResults = [...posts, ...pages];
  
        this.resultsDiv.innerHTML = `
          <h2 class="search-overlay__section-title">General Information</h2>
          ${combinedResults.length ? '<ul class="link=list min-list">' : '<p>No general information matches that search.</p>'}
          ${combinedResults.map(item => `<li><a href="${item.link}">${item.title.rendered}</a></li>`).join('')}
          ${combinedResults.length ? '</ul>' : ''}
        `;
      })
      .catch(error => {
        console.error('Error fetching data:', error);
        this.resultsDiv.innerHTML = `
        <p class="search-overlay__section-title">Unexpected error, please try again</p>`
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
    this.searchField.value = '';
    setTimeout(() => { var searchField = document.getElementById("search-term"); searchField.focus();}, 301)
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
