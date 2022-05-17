let correctAnswerCounter = 0;
let passedQuestionsCounter = 0;
let numbOfQuestions = 0;

const showQuestionScreen = () => {
  document
    .querySelector("#start-button")
    .addEventListener("click", function () {
      // document.querySelector("#start-page").style.display = "none";
      document.querySelector("#start-page").classList.add('d-none');
      // document.querySelector("#question-screen").style.display = "block";
      document.querySelector("#question-screen").classList.remove('d-none');
      document.querySelector("#question-screen").classList.add('d-block');
      document.querySelector("#last-page").classList.add('d-none');
    });
};
showQuestionScreen();

const responseData = fetch("https://opentdb.com/api.php?amount=20")
  .then((res) => {
    setTimeout(() => {
      document.querySelector('#loader').classList.remove('d-flex');
      document.querySelector('#loader').classList.add('d-none');
      document.querySelector('#start-page').classList.remove('d-none');
    }, 1000);
    return res.json();
  })
  .then((data) => {
    console.log(data.results);
    numbOfQuestions = data.results.length;
    return data.results;
  })
  .catch((err) => {
    confirm;
  });

window.addEventListener("hashchange", function () {
  const hash = window.location.hash;
  const hashNumb = hash.replace("#", "");
  showNextQuestion(parseInt(hashNumb));
});

function showNextQuestion(questionId) {
  responseData
    .then((data) => {
      if (questionId <= data.length) {
        let question = data[questionId];
        return question;
      }
    })
    .then((questionData) => {
      createQuestionContainer(questionData, questionId);
    });
}

function createQuestionContainer(questionElement, questId) {
 
  document.querySelector("#questions").innerHTML = questionElement.question;
  document.querySelector("#category").innerHTML = questionElement.category;

  
  let btns = document.getElementById("buttons-container");
  btns.innerHTML = "";

  let allAnswers = questionElement.incorrect_answers.concat(
    questionElement.correct_answer
  );
  
  let shuffleAnswers = shuffle(allAnswers);
  let newButton = "";
  
  if (questId < numbOfQuestions - 1) {
    shuffleAnswers.forEach((answer) => {
    
      let sth = questionElement.correct_answer.replace("&#039;", " ");
      newButton += `
      <button type="button" class="btn btn-outline-dark" value="${answer}"
      onclick="goToNextQuestion('${sth}')">${answer}</button>
        `;
      document.querySelector("#buttons-container").innerHTML = newButton;
    });
  } else {
  
    shuffleAnswers.forEach((answer) => {
      newButton += `
      <button type="button" class="btn btn-outline-dark" value="${answer}"
      onclick='goToFinalScreen("${questionElement.correct_answer}")'>${answer}</button>
        `;
      document.querySelector("#buttons-container").innerHTML = newButton;
    });
  }
}

function goToNextQuestion(correcAnswer) {
  const hash = window.location.hash;
  let hashNumb = hash.replace("#", "");
  hashNumb = parseInt(hashNumb) + 1;
  if (hashNumb < numbOfQuestions) {
    window.location.hash = "#" + hashNumb;
  }

  if (event.target.value == correcAnswer) {
    correctAnswerCounter++;
    console.log("correctAnswCounter", correctAnswerCounter);
  }
  passedQuestionsCounter++;
  document.querySelector("#counter-answer").innerHTML = passedQuestionsCounter;
}

function goToFinalScreen(corrAnswer) {
  if (event.target.value == corrAnswer) {
    correctAnswerCounter++;
  }
  document.querySelector("#correct-answer").innerHTML = correctAnswerCounter;
  // document.querySelector("#question-screen").style.display = "none";
  document.querySelector("#question-screen").classList.remove('d-block');
  document.querySelector("#question-screen").classList.add('d-none');
  // document.querySelector("#last-page").style.display = "block";
  document.querySelector("#last-page").classList.remove('d-none');
  document.querySelector("#last-page").classList.add('d-block');
}

function showTakenQuestions() {
  document.querySelector("#counter-answer").innerHTML = passedQuestionsCounter;
}

function shuffle(array) {
  return array.sort(() => Math.random() - 0.5);
}