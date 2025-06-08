<template>
  <div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
      <!-- Header -->
      <div class="text-center">
        <div class="mx-auto h-12 w-12 flex items-center justify-center rounded-full bg-blue-100">
          <BeakerIcon class="h-6 w-6 text-blue-600" />
        </div>
        <h1 class="mt-6 text-3xl font-bold text-gray-900 sm:text-4xl">
          Phlebotomy Quiz
        </h1>
        <p class="mt-2 text-sm text-gray-600 sm:text-base">
          Test your situational judgment skills
        </p>
      </div>

      <!-- Content -->
      <div class="mt-8 space-y-6">
        <div class="rounded-lg bg-white p-6 shadow-sm border border-gray-200">
          <h2 class="text-lg font-semibold text-gray-900 mb-4">
            What to Expect
          </h2>
          <ul class="space-y-3 text-sm text-gray-600">
            <li class="flex items-start">
              <svg class="h-5 w-5 text-green-500 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
              </svg>
              <span>15 scenario-based questions</span>
            </li>
            <li class="flex items-start">
              <svg class="h-5 w-5 text-green-500 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
              </svg>
              <span>Immediate feedback and explanations</span>
            </li>
            <li class="flex items-start">
              <svg class="h-5 w-5 text-green-500 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
              </svg>
              <span>Real-world phlebotomy situations</span>
            </li>
          </ul>
        </div>

        <!-- Start Button -->
        <button
          @click="startQuiz"
          class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200 shadow-sm hover:shadow-md"
          aria-label="Begin the phlebotomy quiz"
        >
          <span class="absolute left-0 inset-y-0 flex items-center pl-3">
            <svg class="h-5 w-5 text-blue-500 group-hover:text-blue-400 transition-colors duration-200" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
              <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
            </svg>
          </span>
          Begin Quiz
        </button>
      </div>

      <!-- Footer -->
      <p class="mt-6 text-center text-xs text-gray-500">
        Professional training assessment • No time limit
      </p>
    </div>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router'
import { BeakerIcon } from '@heroicons/vue/24/solid'

const router = useRouter()

const startQuiz = () => {
  router.push('/quiz')
}
</script>