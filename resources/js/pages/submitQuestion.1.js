import { router } from '@inertiajs/vue3';
import { createdQuestion, validateAnswers, answerCount, newAnswers } from './Questions.vue';

export function submitQuestion() {
if (!createdQuestion.value) {
alert('Question can not be empty');
return false;
}
if (!validateAnswers() && !answerCount()) {
alert('Fill all inputs before submitting');
return false;
}

router.post('/questions', {
question: createdQuestion.value,
answers: newAnswers.value
});

}
