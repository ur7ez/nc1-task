<template xmlns="http://www.w3.org/1999/html">
  <PageComponent>
    <template v-slot:header>
      <h1 class="text-3xl font-bold tracking-tight text-gray-900">About [task details]</h1>
    </template>
    <h2 class="text-2xl font-bold tracking-tight text-gray-700">PHP Developer Test </h2>
    <div class="">
      <section class="text-sm">
        <h3 class="text-xl font-semibold text-gray-700 py-3 underline">API</h3>
        <div>
          Using the provided CSV data, create an API route using Laravel that allows the data to be searched.
          <p class="my-2">The data should be converted to a database table. Provide Laravel migrations and seeders
            within the
            project.</p>
          The API should search on:
          <ul class="list-disc mx-10 py-4">
            <li>Name: Should also match on partial names</li>
            <li>Bedrooms: Exact match</li>
            <li>Bathrooms: Exact match</li>
            <li>Storeys: Exact match</li>
            <li>Garages: Exact match</li>
            <li>Price: Range (between $X and $Y)</li>
          </ul>
          <p>
            All search parameters should be optional, we should be able to search for 2 bedroom houses, or 4 bedroom and
            2 bathroom houses, etc.
          </p>
          <p class="mx2">The API should return JSON, with pure numeric data (not HTML content).</p>
        </div>
      </section>
      <section class="text-sm">
        <h3 class="text-xl font-semibold text-gray-700 py-3 underline">Frontend (Search Form)</h3>
        <p>
          Create a basic search form that will query the API using AJAX and display the results it receives from the
          backend. The searching result should be rendering to HTML table dynamically on the frontend, using reactive
          Vue.js
        </p>
        <p class="my-2">
          There should be some sort of searching indicator, a spinning icon or similar.
        </p>
        <p>
          A message should be displayed if no results were found.
        </p>
      </section>
    </div>
  </PageComponent>
</template>

<script setup>
import PageComponent from "../components/PageComponent.vue";
</script>
