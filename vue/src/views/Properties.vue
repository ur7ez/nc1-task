<template>
  <PageComponent>
    <template v-slot:header>
      <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900">Properties data search</h1>
        <div>
          <!-- ... or maybe put Search form button here ... -->
        </div>
      </div>
    </template>
    <!-- Search form -->
    <form @submit.prevent="searchProperty">

      <Alert v-if="errorMsg" class="">
        <span v-html="errorMsg"></span>
        <span @click="errorMsg = ''"
              class="w-8 h-8 flex items-center justify-center rounded-full transition-colors cursor-pointer hover:bg-[rgba(0,0,0,0.2)]">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
               stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </span>
      </Alert>

      <div class="shadow-sm sm:rounded-md sm:overflow-hidden px-4 py-5 bg-white space-y-6 sm:p-6">
        <p class="mt-1 text-sm leading-6 text-gray-600">To search for existing properties fill any of the fields below and hit <span class="text-gray-700 font-semibold bg-gray-200 p-1">Search</span> button</p>
        <!-- Property Fields (search form) -->
        <div class="gap-x-6 gap-y-8 grid grid-cols-1 mt-10 sm:grid-cols-6">
          <!-- Name -->
          <div class="sm:col-span-2 sm:col-start-1">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <div class="mt-2">
              <input type="text" name="name" id="name" autocomplete="on"
                     placeholder="any name part is fine"
                     v-model="property.name"
                     class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md text-gray-900 placeholder:text-gray-400"/>
            </div>
          </div>
          <!-- / Name -->
          <!-- Price -->
          <div class="sm:col-span-2">
            <label for="price_min" class="block text-sm font-medium text-gray-700">Price (from)</label>
            <div class="mt-2">
              <input type="number" name="price.min" id="price_min" min="0" step="1"
                     placeholder="positive number"
                     v-model="property.price.min"
                     class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md placeholder:text-gray-400"/>
            </div>
          </div>
          <div class="sm:col-span-2">
            <label for="price_max" class="block text-sm font-medium text-gray-700">Price (to)</label>
            <div class="mt-2">
              <input type="number" name="price.max" id="price_max" min="0" step="1"
                     placeholder="positive number"
                     v-model="property.price.max"
                     class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md placeholder:text-gray-400"/>
            </div>
          </div>
          <!-- / Price -->
          <!-- Bedrooms -->
          <div>
            <label for="bedrooms" class="block text-sm font-medium text-gray-700">Bedrooms</label>
            <div class="mt-2">
              <input type="number" name="bedrooms" id="bedrooms" min="0" step="1"
                     placeholder="positive number"
                     v-model="property.bedrooms"
                     class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md placeholder:text-gray-400"/>
            </div>
          </div>
          <!-- / Bedrooms -->
          <!-- Bathrooms -->
          <div>
            <label for="bathrooms" class="block text-sm font-medium text-gray-700">Bathrooms</label>
            <div class="mt-2">
              <input type="number" name="bathrooms" id="bathrooms" min="0" step="1"
                     placeholder="positive number"
                     v-model="property.bathrooms"
                     class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md placeholder:text-gray-400"/>
            </div>
          </div>
          <!-- / Bathrooms -->
          <!-- Storeys -->
          <div>
            <label for="storeys" class="block text-sm font-medium text-gray-700">Storeys</label>
            <div class="mt-2">
              <input type="number" name="storeys" id="storeys" min="0" step="1"
                     placeholder="positive number"
                     v-model="property.storeys"
                     class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md placeholder:text-gray-400"/>
            </div>
          </div>
          <!-- / Storeys -->
          <!-- Garages -->
          <div>
            <label for="garages" class="block text-sm font-medium text-gray-700">Garages</label>
            <div class="mt-2">
              <input type="number" name="garages" id="garages" min="0" step="1"
                     placeholder="positive number"
                     v-model="property.garages"
                     class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md placeholder:text-gray-400"/>
            </div>
          </div>
          <!-- / Garages -->
        </div>
        <!-- / Property Fields (search form) -->
      </div>

      <!-- Form buttons -->
      <div class="mt-3 mb-3 flex items-center justify-end gap-x-6">
        <button type="reset" @click="resetData" class="p-2 text-sm font-semibold leading-6 text-gray-900">Reset</button>
        <button type="submit"
                class="py-2 px-3 w-[110px] relative justify-center border border-transparent shadow-sm text-sm text-white font-medium rounded-md bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
          <DocumentMagnifyingGlassIcon class="absolute left-2 h-5 w-5" aria-hidden="true"/>
          <span class="pl-4">Search</span>
        </button>
      </div>
      <!-- / Form buttons -->
    </form>
    <!-- / Search form -->

    <div v-if="properties.loading" class="flex justify-center">Loading...</div>
    <div v-else-if="properties.data.length">
      <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-3">
        <PropertyList
          v-for="(property, ind) in properties.data"
          :key="property.id"
          :property="property"
          class="opacity-0 animate-fade-in-down"
          :style="{ animationDelay: `${ind * 0.1}s` }"
        />
      </div>

      <!-- Pagination -->
      <div v-if="properties.links" class="flex justify-center mt-5">
        <nav class="relative z-0 inline-flex justify-center rounded-md shadow-sm -space-x-px"
          aria-label="pagination">
          <a
            v-for="(link, i) of properties.links"
            :key="i"
            :disabled="!link.url"
            href="#"
            @click.prevent="getForPage($event, link)"
            aria-current="page"
            class="relative inline-flex items-center px-4 py-2 border text-sm font-medium whitespace-nowrap"
            :class="[
              link.active
                ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600'
                : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
              i === 0 ? 'rounded-l-md bg-gray-100 text-gray-700' : '',
              i === properties.links.length - 1 ? 'rounded-r-md' : '',
            ]"
            v-html="link.label">
          </a>
        </nav>
      </div>
      <!-- / Pagination -->

    </div>
    <div v-else class="text-gray-600 text-center py-16">
      No properties were found (or maybe forgot to seed Database?)
    </div>
  </PageComponent>
</template>

<script setup>
import {DocumentMagnifyingGlassIcon} from "@heroicons/vue/24/solid"
import PageComponent from "../components/PageComponent.vue";
import PropertyList from "../components/PropertyList.vue";
import Alert from "../components/Alert.vue";
import {computed, reactive, ref} from "vue";
import store from "../store/index.js";
// import {useRouter} from "vue-router";

const properties = computed(() => store.state.properties);
store.dispatch("getProperties");

const getInitialFormData = () => ({
  name: "",
  price: {min: null, max: null},
  bedrooms: null,
  bathrooms: null,
  storeys: null,
  garages: null,
});
const property = reactive(getInitialFormData());
const resetSearchProrertyForm = () => Object.assign(property, getInitialFormData());

let errorMsg = ref("");

// const router = useRouter();
function searchProperty() {
  store
    .dispatch("searchProperty", property)
    .then(() => {
      // router.push({name: "Properties",});
    })
    .catch((err) => {
      let error = err.response?.data ?? null;
      if (error) {
        errorMsg.value = (error.message || '') + ("<div><pre>" + (error.errors ? JSON.stringify(error.errors) : null) + "</pre></div>");
      } else if (err.message ?? null) {
        error = JSON.stringify(err.message);
        errorMsg.value = error;
      } else {
        error = 'Something went wrong' + ("<pre>" + JSON.stringify(err)+ "</pre>");
        errorMsg.value = error;
      }
      store.commit("notify", {
        type: "error",
        message: "Propety search failed: \n" + error,
      });
    });
}

function resetData() {
  resetSearchProrertyForm();
}

function getForPage(ev, link) {
  if (!link.url || link.active) {
    return;
  }
  store.dispatch("getProperties", { url: link.url });
}
</script>
