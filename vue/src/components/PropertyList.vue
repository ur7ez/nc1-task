<template>
  <div class="flex flex-col py-2 px-4 shadow-md bg-white hover:bg-gray-50">
    <pre>
      {{ property }}
    </pre>
  </div>
</template>

<script setup>
const {property} = defineProps({
  property: Object,
});
</script>
