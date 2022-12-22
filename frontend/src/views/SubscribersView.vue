<template>
  <main class="max-w-8xl mx-auto px-4 py-8">
    <h1>Subsribers</h1>
    <ul>
      <li v-for="subscriber in subscribers" :key="subscriber.id">
        {{ subscriber.name }}
      </li>
    </ul>
  </main>
</template>

<script>
export default {
  data() {
    return {
      subscribers: [],
    };
  },
  created() {
    this.retrieveSubscribers();
  },
  methods: {
    retrieveSubscribers() {
      this.$axios
        .get("/subscribers")
        .then((response) => {
          this.subscribers = response.data.data;
          console.log(response.data.data);
        })
        .catch((e) => {
          console.log(e);
        });
    },
  },
};
</script>
