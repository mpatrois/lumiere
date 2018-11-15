<template>
  <section>
    <h1>UPLOADER VIEW</h1>
    <form>
      <fieldset>
        <input type="text" placeholder="Titre de la vidéo">
        <textarea placeholder="Description de la vidéo" />
      </fieldset>
      <label for="title">
      </label>
      <label for="video"></label>
      Votre vidéo : 
      <input type="file" id="video" />
    </form>
  </section>
</template>

<script>
export default {
  name: 'Uploader',
};
</script>


<style lang="scss">
  fieldset {
    border: none;
  }
</style>
