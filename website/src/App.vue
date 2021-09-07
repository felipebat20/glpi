<template>
  <div id="app">
    <header class="mh-20">
      <NavigationBar />
    </header>

    <main class="mw-70">
      <router-view />
    </main>

      <footer>
        <Footer />
      </footer>
  </div>
</template>

<script>
  import NavigationBar from './components/NavigationBar.vue';
  import Footer from './components/Common/Footer.vue';

export default {
  name: 'App',
  components: { NavigationBar, Footer },
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
  background: #0f0c29;
  overflow-x: hidden;
  background: -webkit-linear-gradient(to right, #24243e, #302b63, #0f0c29);
  background: linear-gradient(to right, #24243e, #302b63, #0f0c29);
}

.panel {
    background: #D3CCE3;
    background: -webkit-linear-gradient(to right, #E9E4F0, #D3CCE3);
    background: linear-gradient(to right, #E9E4F0, #D3CCE3);
}
main {
  max-width: 1200px;
  margin: auto;
}
</style>
