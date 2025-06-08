<template>
  <div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
      <!-- Header with Exit Button -->
      <div class="relative text-center mb-8">
        <!-- Exit Button -->
        <button
          v-if="currentQuestion && !isQuizCompleted"
          @click="showExitModal = true"
          class="absolute right-0 top-0 px-3 py-1 text-sm text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400"
        >
          Exit Quiz
        </button>
        
        <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">
          Phlebotomy Situational Quiz
        </h1>
        <p class="mt-2 text-gray-600">
          Choose the best response for each scenario
        </p>
      </div>

      <!-- Loading State -->
      <div v-if="isLoading" class="flex justify-center items-center py-12">
        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
        <span class="ml-3 text-gray-600">Loading questions...</span>
      </div>

      <!-- Error State -->
      <div v-else-if="error" class="bg-red-50 border border-red-200 rounded-lg p-6 text-center">
        <svg class="mx-auto h-12 w-12 text-red-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z" />
        </svg>
        <h3 class="text-lg font-medium text-red-800 mb-2">Error Loading Quiz</h3>
        <p class="text-red-700 mb-4">{{ error }}</p>
        <button
          @click="fetchQuestions"
          class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200"
        >
          Try Again
        </button>
      </div>

      <!-- Quiz Content -->
      <div v-else-if="currentQuestion && !isQuizCompleted" class="space-y-6">
        <!-- Progress Bar -->
        <ProgressBar
          :current-question="currentQuestionIndex + 1"
          :total-questions="totalQuestions"
          :progress="progress"
        />

        <!-- Question Card -->
        <QuestionCard
          :question="currentQuestion"
          :is-last-question="currentQuestionIndex === totalQuestions - 1"
          @answer-selected="handleAnswerSelected"
          @next="handleNext"
        />
      </div>

      <!-- Quiz Completed - Redirect to Results -->
      <div v-else-if="isQuizCompleted" class="flex justify-center items-center py-12">
        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
        <span class="ml-3 text-gray-600">Calculating results...</span>
      </div>

      <!-- Empty State -->
      <div v-else class="text-center py-12">
        <p class="text-gray-500">No questions available</p>
        <button
          @click="$router.push('/')"
          class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200"
        >
          Return to Home
        </button>
      </div>
    </div>

    <!-- Exit Confirmation Modal -->
    <div v-if="showExitModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center z-50">
      <div class="relative bg-white rounded-lg shadow-xl max-w-md mx-auto m-4">
        <div class="p-6">
          <div class="flex items-center mb-4">
            <svg class="h-6 w-6 text-amber-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z" />
            </svg>
            <h3 class="text-lg font-semibold text-gray-900">Exit Quiz?</h3>
          </div>
          
          <p class="text-gray-600 mb-6">
            Are you sure you want to exit the quiz? Your progress will not be saved and you'll need to start over.
          </p>
          
          <div class="flex justify-end space-x-3">
            <button
              @click="showExitModal = false"
              class="px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400"
            >
              Continue Quiz
            </button>
            <button
              @click="exitQuiz"
              class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200"
            >
              Exit Quiz
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted, watch, ref } from 'vue'
import { useRouter } from 'vue-router'
import { useQuiz } from '../composables/useQuiz'
import ProgressBar from '../components/ProgressBar.vue'
import QuestionCard from '../components/QuestionCard.vue'

const router = useRouter()

const {
  questions,
  currentQuestionIndex,
  currentQuestion,
  isLoading,
  error,
  isQuizCompleted,
  progress,
  totalQuestions,
  fetchQuestions,
  submitAnswer,
  nextQuestion,
  resetQuiz
} = useQuiz()

const showExitModal = ref(false)

onMounted(async () => {
  if (questions.value.length === 0) {
    await fetchQuestions()
  }
})

// Watch for quiz completion and redirect
watch(isQuizCompleted, (completed) => {
  if (completed) {
    // Small delay for UX - let user see the completion state briefly
    setTimeout(() => {
      router.push('/completion')
    }, 1500)
  }
})

const handleAnswerSelected = ({ selectedOptionId, isCorrect }) => {
  submitAnswer(selectedOptionId)
}

const handleNext = () => {
  nextQuestion()
}

const exitQuiz = () => {
  resetQuiz()
  router.push('/')
}
</script>