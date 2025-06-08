<template>
  <div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
      <!-- Header -->
      <div class="text-center mb-8">
        <div class="mx-auto h-16 w-16 flex items-center justify-center rounded-full mb-6" :class="scoreHeaderClasses">
          <svg v-if="scorePercentage >= 80" class="h-8 w-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
          </svg>
          <svg v-else-if="scorePercentage >= 60" class="h-8 w-8 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
          </svg>
          <svg v-else class="h-8 w-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
          </svg>
        </div>
        
        <h1 class="text-3xl font-bold text-gray-900 sm:text-4xl mb-2">
          Quiz Complete!
        </h1>
        <p class="text-gray-600">
          {{ getScoreMessage() }}
        </p>
      </div>

      <!-- Score Summary -->
      <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <!-- Score -->
          <div class="text-center">
            <div class="text-3xl font-bold mb-2" :class="scoreTextClasses">
              {{ score }}/{{ totalQuestions }}
            </div>
            <p class="text-sm text-gray-600">Questions Correct</p>
          </div>
          
          <!-- Percentage -->
          <div class="text-center">
            <div class="text-3xl font-bold mb-2" :class="scoreTextClasses">
              {{ scorePercentage }}%
            </div>
            <p class="text-sm text-gray-600">Overall Score</p>
          </div>
          
          <!-- Performance -->
          <div class="text-center">
            <div class="text-3xl font-bold mb-2" :class="performanceClasses">
              {{ getPerformanceLevel() }}
            </div>
            <p class="text-sm text-gray-600">Performance</p>
          </div>
        </div>
      </div>

      <!-- Results Breakdown -->
      <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-900 mb-6">
          Question Review
        </h2>
        
        <div class="space-y-4 max-h-96 overflow-y-auto">
          <div
            v-for="(answer, index) in userAnswers"
            :key="answer.questionId"
            class="flex items-start p-4 rounded-lg border-2"
            :class="answer.isCorrect ? 'border-green-200 bg-green-50' : 'border-red-200 bg-red-50'"
          >
            <div class="flex-shrink-0 mr-4">
              <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-semibold"
                   :class="answer.isCorrect ? 'bg-green-500 text-white' : 'bg-red-500 text-white'">
                {{ index + 1 }}
              </div>
            </div>
            
            <div class="flex-1 min-w-0">
              <div class="flex items-center mb-2">
                <svg v-if="answer.isCorrect" class="h-5 w-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <svg v-else class="h-5 w-5 text-red-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
                <span class="font-medium" :class="answer.isCorrect ? 'text-green-800' : 'text-red-800'">
                  {{ answer.isCorrect ? 'Correct' : 'Incorrect' }}
                </span>
              </div>
              
              <p class="text-sm mb-2" :class="answer.isCorrect ? 'text-green-700' : 'text-red-700'">
                <span class="font-medium">Your answer:</span> {{ answer.selectedText }}
              </p>
              
              <p v-if="!answer.isCorrect" class="text-sm text-gray-600 mb-2">
                <span class="font-medium">Correct answer:</span> 
                {{ getCorrectAnswerText(answer.questionId, answer.correctAnswerId) }}
              </p>
              
              <p class="text-xs" :class="answer.isCorrect ? 'text-green-600' : 'text-red-600'">
                {{ answer.explanation }}
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Actions -->
      <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <button
          @click="retakeQuiz"
          class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200 font-medium"
        >
          Take Quiz Again
        </button>
        
        <button
          @click="goHome"
          class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200 font-medium"
        >
          Return to Home
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { useRouter } from 'vue-router'
import { useQuiz } from '../composables/useQuiz'

const router = useRouter()

const {
  questions,
  userAnswers,
  score,
  totalQuestions,
  scorePercentage,
  resetQuiz
} = useQuiz()

// Computed styling classes
const scoreHeaderClasses = computed(() => {
  if (scorePercentage.value >= 80) return 'bg-green-100'
  if (scorePercentage.value >= 60) return 'bg-yellow-100'
  return 'bg-red-100'
})

const scoreTextClasses = computed(() => {
  if (scorePercentage.value >= 80) return 'text-green-600'
  if (scorePercentage.value >= 60) return 'text-yellow-600'
  return 'text-red-600'
})

const performanceClasses = computed(() => {
  if (scorePercentage.value >= 80) return 'text-green-600'
  if (scorePercentage.value >= 60) return 'text-yellow-600'
  return 'text-red-600'
})

// Helper functions
const getScoreMessage = () => {
  if (scorePercentage.value >= 80) {
    return 'Excellent work! You have a strong understanding of phlebotomy best practices.'
  } else if (scorePercentage.value >= 60) {
    return 'Good effort! Consider reviewing some key concepts to improve your knowledge.'
  } else {
    return 'Keep studying! Phlebotomy requires careful attention to safety and procedures.'
  }
}

const getPerformanceLevel = () => {
  if (scorePercentage.value >= 80) return 'Excellent'
  if (scorePercentage.value >= 60) return 'Good'
  return 'Needs Work'
}

const getCorrectAnswerText = (questionId, correctAnswerId) => {
  const question = questions.value.find(q => q.id === questionId)
  if (!question) return ''
  
  const correctOption = question.options.find(opt => opt.id === correctAnswerId)
  return correctOption ? correctOption.text : ''
}

const retakeQuiz = () => {
  resetQuiz()
  router.push('/quiz')
}

const goHome = () => {
  resetQuiz()
  router.push('/')
}
</script>