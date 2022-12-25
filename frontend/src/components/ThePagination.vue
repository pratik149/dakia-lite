<template>
  <div class="px-6 py-6">
    <nav aria-label="Page navigation" class="flex justify-between">
      <div class="text-sm text-gray-500">
        Showing
        <strong> {{ collection.from }} </strong>
        to
        <strong> {{ collection.to }} </strong>
        of
        <strong> {{ collection.total }} </strong>
        results
      </div>

      <div class="space-x-2">
        <button
          class="rounded bg-gray-100 px-4 py-2.5 text-sm text-gray-500"
          :class="{ 'transition hover:bg-gray-200': collection.prev_page_url }"
          :disabled="collection.prev_page_url ? false : true"
          @click="prevPage()"
        >
          Previous
        </button>

        <button
          class="rounded bg-gray-100 px-4 py-2.5 text-sm text-gray-500"
          :class="{ 'transition hover:bg-gray-200': collection.next_page_url }"
          :disabled="collection.next_page_url ? false : true"
          @click="nextPage()"
        >
          Next
        </button>
      </div>
    </nav>
  </div>
</template>

<script>
export default {
  props: {
    collection: Object,
  },
  methods: {
    prevPage() {
      const pageNumber = new URL(this.collection.prev_page_url).searchParams.get("page");
      this.$router.push(`${this.$route.path}?page=${pageNumber}`);
    },
    nextPage() {
      const pageNumber = new URL(this.collection.next_page_url).searchParams.get("page");
      this.$router.push(`${this.$route.path}?page=${pageNumber}`);
    },
  },
};
</script>
