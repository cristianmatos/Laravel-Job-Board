require('./bootstrap');

import Alpine from 'alpinejs';
import axios from 'axios';

window.Alpine = Alpine;

Alpine.store('results', {
  loading: false,

  setNextPage(page) {
      this.nextPage = page
  }
})

Alpine.store('pagination', {
  nextPage: 2,
  hasMore: false,

  setNextPage(page, hasMore) {
      this.nextPage = page
      this.hasMore = hasMore
  }
})

window.jobList = function(_hasMore) {
  let paginationStore = Alpine.store('pagination')

  return {
    searchQuery: '',
    hasMore: _hasMore,
    nextPage: 2,
    loading:false,
    loadingMore: false,
    searchText: '',
    
    search(){
      this.loading = true
      axios.get('/search', {
        params: {
          q: this.searchQuery
        }
      })
        .then((response) => {
          let jobListContainer = document.getElementById('joblist-container')
          jobListContainer.innerHTML = response.data.content
          this.hasMore = response.data.has_more_pages
          this.searchText = response.data.search_text
        })
        .finally(() => {
          this.loading = false
        })
    },

    loadMoreJobs(){
      let requestUrl = `/load-more-jobs?page=${this.nextPage}`

      this.loadingMore = true

      axios.get(requestUrl)
        .then((response) => {
            let jobList = document.getElementById('joblist-container')
            jobList.innerHTML += response.data.content
            this.hasMore = response.data.has_more_pages
            this.nextPage = response.data.next_page
        }).finally(() => {
          this.loadingMore = false
        })
    }
  }
}

Alpine.start();

// window.loadMoreJobs = function (e) {
//   let store = Alpine.store('pagination')
//   let requestUrl = `/load-more-jobs?page=${store.nextPage}`

//   axios.get(requestUrl)
//     .then((response) => {
//         let jobList = document.getElementById('joblist-container')
//         jobList.innerHTML += response.data.content

//         store.setNextPage(response.data.next_page, response.data.has_more_pages)

//         if ( response.data.has_more_pages === false) {
//           e.target.remove()
//         }
//     })
// }