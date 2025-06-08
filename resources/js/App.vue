<template>
    <div id="app" class="min-h-screen bg-gray-50 relative">
        <!-- Subtle background image -->
        <div class="fixed inset-0 bg-cover bg-center bg-no-repeat opacity-35 pointer-events-none" 
             style="background-image: url('/images/background.png')"></div>
        
        <!-- Content overlay -->
        <div class="relative z-10">
            <router-view />
        </div>
    </div>
</template>

<script setup>
import { onMounted, onUnmounted } from 'vue'
import { useQuiz } from './composables/useQuiz'

const { pingBackend } = useQuiz()

let keepAliveInterval = null

// Set up keep-alive mechanism
onMounted(() => {
  // Only enable in production to avoid unnecessary requests during development
  if (import.meta.env.PROD) {
    // Ping every 10 minutes (600000 ms)
    keepAliveInterval = setInterval(pingBackend, 600000)
    
    // Initial ping after 30 seconds
    setTimeout(pingBackend, 30000)
  }
})

onUnmounted(() => {
  if (keepAliveInterval) {
    clearInterval(keepAliveInterval)
  }
})
</script>