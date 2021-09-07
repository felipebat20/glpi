<template>
  <div id="app">
      <NavigationBar />
      <router-view />
  </div>
</template>

<script>
  import NavigationBar from './components/NavigationBar.vue';
export default {
  name: 'App',
  components: { NavigationBar },
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
  background: #0f0c29;
  background: -webkit-linear-gradient(to right, #24243e, #302b63, #0f0c29);
  background: linear-gradient(to right, #24243e, #302b63, #0f0c29);
}

.panel {
    background: #D3CCE3;
    background: -webkit-linear-gradient(to right, #E9E4F0, #D3CCE3);
    background: linear-gradient(to right, #E9E4F0, #D3CCE3);
}
</style>
