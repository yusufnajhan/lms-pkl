import { createdQuestion, validateAnswers, answerCount, newAnswers, router } from './Questions.vue';

export function submitQuestion() {
if (!createdQuestion.value) {
alert('Question can not be empty');
return false;
}
if (!validateAnswers() && !answerCount()) {
alert('Fill all inputs before submitting');
return false;
}

const formData = {
question: createdQuestion.value,
answers: newAnswers.value
};

router.post('/questions', formData);

}
