<template>
  <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
    <!-- Scenario -->
    <div class="mb-6">
      <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-3">
        Scenario
      </h3>
      <p class="text-gray-900 leading-relaxed">
        {{ question.scenario }}
      </p>
    </div>

    <!-- Question -->
    <div class="mb-6">
      <h4 class="text-lg font-semibold text-gray-900 mb-4">
        {{ question.question }}
      </h4>
    </div>

    <!-- Options -->
    <div class="space-y-3">
      <button
        v-for="option in question.options"
        :key="option.id"
        @click="selectOption(option.id)"
        :disabled="selectedAnswer !== null"
        :class="getOptionClasses(option.id)"
        class="w-full text-left p-4 rounded-lg border-2 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
        :aria-label="`Option ${option.id.toUpperCase()}: ${option.text}`"
      >
        <div class="flex items-start">
          <span 
            class="flex-shrink-0 w-6 h-6 rounded-full border-2 mr-3 mt-0.5 flex items-center justify-center text-xs font-semibold"
            :class="getOptionIndicatorClasses(option.id)"
          >
            {{ option.id.toUpperCase() }}
          </span>
          <span class="flex-1">{{ option.text }}</span>
        </div>
      </button>
    </div>

    <!-- Feedback -->
    <transition 
      enter-active-class="transition-all duration-300 ease-out"
      enter-from-class="opacity-0 translate-y-2"
      enter-to-class="opacity-100 translate-y-0"
    >
      <div v-if="showFeedback" class="mt-6 p-4 rounded-lg" :class="feedbackClasses">
        <div class="flex items-start">
          <svg 
            v-if="isCorrect" 
            class="h-5 w-5 text-green-600 mr-3 mt-0.5 flex-shrink-0" 
            fill="currentColor" 
            viewBox="0 0 20 20"
            aria-hidden="true"
          >
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
          </svg>
          <svg 
            v-else 
            class="h-5 w-5 text-red-600 mr-3 mt-0.5 flex-shrink-0" 
            fill="currentColor" 
            viewBox="0 0 20 20"
            aria-hidden="true"
          >
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
          </svg>
          <div>
            <p class="font-semibold mb-2" :class="isCorrect ? 'text-green-800' : 'text-red-800'">
              {{ isCorrect ? 'Correct!' : 'Incorrect' }}
            </p>
            <p class="text-sm" :class="isCorrect ? 'text-green-700' : 'text-red-700'">
              {{ question.explanation }}
            </p>
          </div>
        </div>
      </div>
    </transition>

    <!-- Next Button -->
    <div v-if="showFeedback" class="mt-6 flex justify-end">
      <button
        @click="$emit('next')"
        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200 font-medium"
      >
        {{ isLastQuestion ? 'View Results' : 'Next Question' }}
        <svg class="inline-block w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, watch } from 'vue'

const props = defineProps({
  question: {
    type: Object,
    required: true
  },
  isLastQuestion: {
    type: Boolean,
    default: false
  }
})

const emit = defineEmits(['answer-selected', 'next'])

const selectedAnswer = ref(null)
const showFeedback = ref(false)

// Reset state when question changes
watch(() => props.question, () => {
  selectedAnswer.value = null
  showFeedback.value = false
}, { immediate: true })

const isCorrect = computed(() => {
  return selectedAnswer.value === props.question.correctAnswerId
})

const feedbackClasses = computed(() => {
  return isCorrect.value 
    ? 'bg-green-50 border border-green-200' 
    : 'bg-red-50 border border-red-200'
})

const selectOption = (optionId) => {
  if (selectedAnswer.value !== null) return
  
  selectedAnswer.value = optionId
  showFeedback.value = true
  
  emit('answer-selected', {
    selectedOptionId: optionId,
    isCorrect: isCorrect.value
  })
}

const getOptionClasses = (optionId) => {
  const baseClasses = 'hover:bg-gray-50'
  
  if (selectedAnswer.value === null) {
    return `${baseClasses} border-gray-300 hover:border-gray-400`
  }
  
  if (optionId === props.question.correctAnswerId) {
    return 'border-green-500 bg-green-50'
  }
  
  if (optionId === selectedAnswer.value && !isCorrect.value) {
    return 'border-red-500 bg-red-50'
  }
  
  return 'border-gray-300 bg-gray-50 opacity-60'
}

const getOptionIndicatorClasses = (optionId) => {
  if (selectedAnswer.value === null) {
    return 'border-gray-400 text-gray-600'
  }
  
  if (optionId === props.question.correctAnswerId) {
    return 'border-green-500 bg-green-500 text-white'
  }
  
  if (optionId === selectedAnswer.value && !isCorrect.value) {
    return 'border-red-500 bg-red-500 text-white'
  }
  
  return 'border-gray-400 text-gray-500'
}
</script>