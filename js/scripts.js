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
    // Adjust the URL to your custom REST endpoint
    const searchQuery = this.searchField.value;
    const customSearchEndpoint = `${sunnyData.root_url}/wp-json/sunny/v1/search?term=${searchQuery}`;
  
    fetch(customSearchEndpoint)
      .then(response => {
        if (!response.ok) {
          throw new Error(`Network response was not ok: ${response.status}`);
        }
        return response.json();
      })
      .then(results => {
        // Use results to update the HTML
        this.resultsDiv.innerHTML = `
          <div class="row">
            <div class="one-third">
              <h2 class="search-overlay__section-title">General Information</h2>
              ${results.generalInfo.length ? '<ul class="link=list min-list">' : '<p>No general information matches that search.</p>'}
              ${results.generalInfo.map(item => `<li><a href="${item.permalink}">${item.title}</a> ${item.postType == 'post' ? `by ${item.authorName}` : ''}</li>`).join('')}
              ${results.generalInfo.length ? '</ul>' : ''}
            </div>
            <div class="one-third">


            <h2 class="search-overlay__section-title">Events</h2>
            ${results.events.length ? '' : `<p>No events match that search. <a href="${sunnyData.root_url}/events"> View all events</a></p>`}
            ${results.events.map(item => `
            <div class="event-summary">
          <a class="event-summary__date t-center" href="${item.permalink}">
            <span class="event-summary__month">${item.month}</span>
            <span class="event-summary__day">${item.day}</span>
          </a>
          <div class="event-summary__content">
            <h5 class="event-summary__title headline headline--tiny"><a href="${item.permalink}">${item.title}</a></h5>
            <p>${item.description}
               <a href="${item.permalink}" class="nu gray">Learn more</a>
            </p>
          </div>
        </div>
            `).join('')}
    
             
            </div>
            <div class="one-third">
            <h2 class="search-overlay__section-title">Services</h2>
            ${results.services.length ? '<ul class="professor-cards">' : `<p>No services match that search. <a href="${sunnyData.root_url}/services"> View all services</a></p>`}
            ${results.services.map(item => `
            <li class="professor-card__list-item">
            <a class="professor-card" href="${item.permalink}">
              <img class="professor-card__image" src="${item.image}">
              <span class="professor-card__name">
                ${item.title}
              </span>
            </a>
          </li>
            `).join('')}
            ${results.services.length ? '</ul>' : ''}
              <h2 class="search-overlay__section-title">Testimonials</h2>
              ${results.testimonials.length ? '<ul class="link=list min-list">' : `<p>No testimonials match that search. <a href="${sunnyData.root_url}/testimonials"> View all testimonials</a></p>`}
              ${results.testimonials.map(item => `<li><a href="${item.permalink}">${item.title}</a> ${item.postType == 'post' ? `by ${item.authorName}` : ''}</li>`).join('')}
              ${results.testimonials.length ? '</ul>' : ''}
           
            </div>
          </div>
        `;
      })
      .catch(error => {
        console.error('Error fetching data:', error);
        this.resultsDiv.innerHTML = `
          <p class="search-overlay__section-title">Unexpected error, please try again</p>`;
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
    this.searchField.value = "";
    setTimeout(() => {
      var searchField = document.getElementById("search-term");
      searchField.focus();
    }, 301);
    this.isOverlayOpen = true;
  }

  closeOverlay() {
    this.searchOverlay.classList.remove("search-overlay--active");
    document.querySelector("body").classList.remove("body-no-scroll");
    this.isOverlayOpen = false;
  }

  addSearchHTML() {
    document.querySelector("body").insertAdjacentHTML(
      "beforeend",
      `
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
    `
    );
  }
}

document.addEventListener("DOMContentLoaded", function () {
  var amazingSearch = new Search();
});
