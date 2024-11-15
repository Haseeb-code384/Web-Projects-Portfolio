// Get the book element
const book = document.querySelector('#book');

// Get the previous and next page buttons
const previousPageButton = document.querySelector('#previous-page');
const nextPageButton = document.querySelector('#next-page');

// Get the progress bar element
const progressBar = document.querySelector('.progress-bar');
const progressBarIndicator = document.querySelector('.progress-bar-indicator');

// Get the current page index
let currentPageIndex = 0;

// Show the current page
function showCurrentPage() {
  const currentPage = book.querySelector('#page-' + currentPageIndex);
  currentPage.classList.add('turn-page');

      
    currentPage.classList.add('previous');
 
    currentPage.classList.add('next');
 
  currentPage.addEventListener('transitionend', function() {
    currentPage.classList.remove('turn-page');
    currentPage.classList.remove('previous');
    currentPage.classList.remove('next');

    // Update the progress bar
    const progressBarWidth = (currentPageIndex + 1) / book.querySelectorAll('.page').length * 100;
    progressBarIndicator.style.width = progressBarWidth + '%';
  });
}

// Go to the previous page
function previousPage(x) {
    setTimeout(function() {
  window.location.href='view_rubric_info.php?id='+x
}, 0);
  
}

// Go to the next page
function nextPage(x) {
   setTimeout(function() {
  window.location.href='view_rubric_info.php?id='+x
}, 0);
}
// Add event listeners to the previous and next page buttons
previousPageButton.addEventListener('click', previousPage);
nextPageButton.addEventListener('click', nextPage);

// Show the first page
//showCurrentPage();
