<template>
  <div class="flex items-center gap-2 text-sm">
    <div class="flex items-center gap-1.5">
      <div :class="statusClasses" class="w-2 h-2 rounded-full transition-all duration-500"></div>
      <span class="text-gray-600">{{ statusText }}</span>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'

const status = ref('checking') // 'online', 'offline', 'checking'
const checkInterval = ref(null)

const statusClasses = computed(() => {
  switch (status.value) {
    case 'online':
      return 'bg-green-500 shadow-sm shadow-green-400/50'
    case 'offline':
      return 'bg-red-500'
    case 'checking':
      return 'bg-yellow-500 animate-pulse'
    default:
      return 'bg-gray-400'
  }
})

const statusText = computed(() => {
  switch (status.value) {
    case 'online':
      return 'Server Online'
    case 'offline':
      return 'Server Offline'
    case 'checking':
      return 'Checking...'
    default:
      return 'Unknown'
  }
})

const checkServerStatus = async () => {
  try {
    const controller = new AbortController()
    const timeoutId = setTimeout(() => controller.abort(), 5000) // 5 second timeout
    
    const response = await fetch(`${import.meta.env.VITE_API_URL}/api/ping`, {
      signal: controller.signal
    })
    
    clearTimeout(timeoutId)
    
    if (response.ok) {
      status.value = 'online'
    } else {
      status.value = 'offline'
    }
  } catch (err) {
    // Network error or timeout
    status.value = 'offline'
  }
}

onMounted(() => {
  // Initial check
  checkServerStatus()
  
  // Check every 30 seconds
  checkInterval.value = setInterval(checkServerStatus, 30000)
})

onUnmounted(() => {
  if (checkInterval.value) {
    clearInterval(checkInterval.value)
  }
})
</script>