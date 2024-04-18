
document.getElementById('search-button').addEventListener('click', function() {
    var searchValue = document.getElementById('search-box').value;
    // Implement the search functionality or forward to a search handling page
    console.log('Search for:', searchValue);
});
document.querySelectorAll('.questions-list li a').forEach(function(question) {
    question.addEventListener('click', function(event) {
        event.preventDefault(); // Stop the anchor link from clicking through
        var answerId = this.getAttribute('href');
        var answerEl = document.querySelector(answerId);
        if (answerEl) {
            answerEl.style.display = answerEl.style.display === 'block' ? 'none' : 'block';
        }
    });
});
