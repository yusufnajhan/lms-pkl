<script setup>
import Header from '@/shared/Header.vue';
import Footer from '@/shared/Footer.vue';
</script>

<template>
    <div class="container">
        <Header/>

        <slot/>
        <Footer/>

    </div>
    

</template>