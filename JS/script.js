function toggleAnswer(answerId) {
    var answer = document.getElementById(answerId);
    var questionButton = answer.previousElementSibling;


    answer.style.display = answer.style.display === 'block' ? 'none' : 'block';

    questionButton.classList.toggle('active');
}
