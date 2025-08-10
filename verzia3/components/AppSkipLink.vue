<template>
  <a
    href="#main-content"
    class="skip-link"
    @focus="scrollToTarget"
  >
    Preskočiť na hlavný obsah
  </a>
</template>

<script setup lang="ts">
const scrollToTarget = (event: FocusEvent) => {
  const target = event.target as HTMLElement
  target.scrollIntoView({ behavior: 'smooth' })
}
</script>

<style scoped>
.skip-link {
  position: absolute;
  top: -40px;
  left: 16px;
  background: #0052CC;
  color: white;
  padding: 8px 16px;
  text-decoration: none;
  border-radius: 4px;
  z-index: 1000;
  transition: all 0.3s ease;
}

.skip-link:focus {
  top: 16px;
}
</style>
