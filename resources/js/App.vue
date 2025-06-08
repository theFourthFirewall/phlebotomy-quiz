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
// Vue 3 SPA with Router
</script>