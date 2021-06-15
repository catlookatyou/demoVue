<template>
    <div class="text-xs text-red-500 font-semibold" v-show="error">
        {{ error }}
    </div>
</template>

<script>
export default {
    props: ['error']
}
</script>