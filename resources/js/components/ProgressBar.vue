<template>
  <div class="w-full">
    <!-- Progress Info -->
    <div class="flex justify-between items-center mb-2">
      <span class="text-sm font-medium text-gray-700">
        Question {{ currentQuestion }} of {{ totalQuestions }}
      </span>
      <span class="text-sm text-gray-500">
        {{ Math.round(progress) }}% Complete
      </span>
    </div>
    
    <!-- Progress Bar -->
    <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
      <div 
        class="h-2 bg-blue-600 rounded-full transition-all duration-300 ease-out"
        :style="{ width: `${progress}%` }"
        role="progressbar"
        :aria-valuenow="progress"
        aria-valuemin="0"
        aria-valuemax="100"
        :aria-label="`Quiz progress: ${Math.round(progress)}% complete`"
      ></div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  currentQuestion: {
    type: Number,
    required: true
  },
  totalQuestions: {
    type: Number,
    required: true
  },
  progress: {
    type: Number,
    required: true
  }
})
</script>