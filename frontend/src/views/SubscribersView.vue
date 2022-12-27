<template>
  <main class="bg-gray-100">
    <div class="mx-auto max-w-8xl px-4 py-8">
      <div class="mb-8 flex justify-between">
        <h1 class="text-3xl font-semibold">Subscribers</h1>
        <button
          @click="toggleAddSubscriberModal"
          class="rounded bg-green-500 px-6 py-2.5 font-medium text-white transition hover:bg-green-600"
        >
          Add subscriber
        </button>
      </div>

      <div class="rounded bg-white">
        <div class="px-6 py-6">
          <p class="mb-2 text-sm font-medium text-gray-500">Showing All Subscribers</p>
          <p class="text-2xl font-bold">
            <span v-if="isLoading" class="my-4 block h-4 w-16 animate-pulse rounded-2xl bg-gray-100"></span>
            <span v-else>
              {{ subscribers.total }}
            </span>
          </p>
        </div>

        <div class="overflow-x-auto">
          <table class="w-full text-left text-sm text-gray-500">
            <thead class="bg-gray-50 text-green-500">
              <tr>
                <th scope="col" class="py-3 px-6">Email</th>
                <th scope="col" class="py-3 px-6">Name</th>
                <th scope="col" class="py-3 px-6">State</th>
                <th scope="col" class="py-3 px-6">Subscribed</th>
                <th scope="col" class="py-3 px-6 capitalize" v-for="field in fields" :key="field.id">
                  {{ field.title }}
                </th>
              </tr>
            </thead>

            <tbody v-if="isLoading" class="border-b bg-white">
              <tr v-for="i in 5" :key="i" class="animate-pulse space-y-8 border-b p-8">
                <td class="py-3 px-6">
                  <div class="flex items-center justify-between">
                    <div>
                      <div class="mb-2.5 h-2.5 w-24 rounded-full bg-gray-300"></div>
                      <div class="h-2 rounded-full bg-gray-200"></div>
                    </div>
                  </div>
                </td>
                <td class="py-3 px-6">
                  <div class="h-2.5 w-12 rounded-full bg-gray-300"></div>
                </td>
                <td class="py-3 px-6">
                  <div class="h-2.5 w-12 rounded-full bg-gray-300"></div>
                </td>
                <td class="py-3 px-6">
                  <div class="h-2.5 w-12 rounded-full bg-gray-300"></div>
                </td>
                <td v-for="field in fields.length" :key="field.id" class="py-3 px-6">
                  <div class="h-2.5 w-12 rounded-full bg-gray-300"></div>
                </td>
              </tr>
            </tbody>

            <tbody v-else>
              <tr
                v-for="subscriber in subscribers.data"
                :key="subscriber.id"
                class="whitespace-nowrap border-b bg-white last:border-b-0"
              >
                <td class="py-4 px-6 text-green-600 hover:text-green-500 hover:underline">
                  <RouterLink :to="`subscribers/${subscriber.id}`">
                    {{ subscriber.email }}
                  </RouterLink>
                </td>
                <td class="py-4 px-6">{{ subscriber.name }}</td>
                <td class="py-4 px-6 capitalize">{{ subscriber.state }}</td>
                <td class="py-4 px-6">{{ subscriber.created_at }}</td>
                <td class="py-4 px-6" v-for="field in fields" :key="field.id">
                  <span v-for="subscriberField in subscriber.fields" :key="subscriberField.id">
                    <span v-if="field.title === subscriberField.title && subscriberField.type === 'text'">
                      {{ subscriberField.pivot.text_value }}
                    </span>
                    <span v-else-if="field.title === subscriberField.title && subscriberField.type === 'number'">
                      {{ subscriberField.pivot.number_value }}
                    </span>
                    <span v-else-if="field.title === subscriberField.title && subscriberField.type === 'date'">
                      {{ subscriberField.pivot.date_value }}
                    </span>
                    <span v-else-if="field.title === subscriberField.title && subscriberField.type === 'boolean'">
                      {{ subscriberField.pivot.boolean_value }}
                    </span>
                  </span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <ThePagination :collection="subscribers" />
      </div>

      <AddSubscriber
        v-if="isAddSubscriberModalOpen"
        :is-open="isAddSubscriberModalOpen"
        :fields="fields"
        @close-modal="toggleAddSubscriberModal"
        @on-subscriber-created="getSubscribers"
      />
    </div>
  </main>
</template>

<script>
import { RouterLink } from "vue-router";
import ThePagination from "../components/ThePagination.vue";
import AddSubscriber from "../components/AddSubscriber.vue";

export default {
  data() {
    return {
      subscribers: [],
      fields: [],
      isLoading: true,
      page: 1,
      isAddSubscriberModalOpen: false,
    };
  },
  components: {
    RouterLink,
    AddSubscriber,
    ThePagination,
  },
  created() {
    this.getSubscribers();
    this.getFields();
  },
  beforeRouteUpdate(to) {
    this.page = to.query.page;
    this.getSubscribers();
  },
  methods: {
    async getSubscribers() {
      await this.$axios
        .get(`/subscribers?page=${this.page}`)
        .then((response) => {
          this.isLoading = false;
          this.subscribers = response.data;
        })
        .catch((e) => {
          this.isLoading = false;
          console.log(e);
        });
    },
    async getFields() {
      await this.$axios
        .get("/fields")
        .then((response) => {
          this.fields = response.data;
        })
        .catch((e) => {
          console.log(e);
        });
    },
    toggleAddSubscriberModal() {
      this.isAddSubscriberModalOpen = !this.isAddSubscriberModalOpen;
    },
  },
};
</script>

<style scoped>
::-webkit-scrollbar {
  height: 4px;
  width: 7px;
}
::-webkit-scrollbar-track {
  background: #e5e7eb;
  border-radius: 4px;
}
::-webkit-scrollbar-thumb {
  background: #d1d5db;
  border-radius: 4px;
}
</style>
