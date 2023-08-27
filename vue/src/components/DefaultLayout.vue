<template>
  <div class="min-h-full">
    <Disclosure as="nav" class="bg-gray-800" v-slot="{ open }">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <img class="h-8 w-8" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="NC1"/>
            </div>
            <div class="hidden md:block">
              <div class="ml-10 flex items-baseline space-x-4">
                <router-link
                  v-for="item in navigation"
                  :key="item.name"
                  :to="item.to"
                  active-class="bg-gray-900 text-white"
                  :class="[
                    this.$route.name === item.to.name
                      ? ''
                      : 'text-gray-300 hover:bg-gray-700 hover:text-white', 'block rounded-md px-3 py-2 text-base font-medium'
                    ]">
                  {{ item.name }}
                </router-link>
              </div>
            </div>
          </div>

          <div class="hidden md:block">
            <div class="ml-4 flex items-center md:ml-6">
              <!-- Profile -->
              <Menu as="div" class="ml-3 relative">
                <div class="flex">
                  <MenuButton
                    class="max-w-xs bg-gray-800 rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                    <div class="mx-3">
                      <div class="text-left text-base font-medium leading-none text-white">
                        {{ user.name }}
                      </div>
                      <div class="text-sm font-medium leading-none text-gray-400">
                        {{ user.email }}
                      </div>
                    </div>
                    <a :href="user.github" title="my GitHub page" target="_blank">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-8 w-8" fill="none"
                        viewBox="0 0 24 24" stroke="white">
                        <path
                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                      </svg>
                    </a>
                  </MenuButton>
                </div>
              </Menu>
              <!-- / Profile -->
            </div>
          </div>

          <div class="-mr-2 flex md:hidden">
            <!-- Mobile menu button -->
            <DisclosureButton
              class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
              <span class="absolute -inset-0.5"/>
              <span class="sr-only">Open main menu</span>
              <Bars3Icon v-if="!open" class="block h-6 w-6" aria-hidden="true"/>
              <XMarkIcon v-else class="block h-6 w-6" aria-hidden="true"/>
            </DisclosureButton>
          </div>
        </div>
      </div>

      <DisclosurePanel class="md:hidden">
        <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
          <router-link
            v-for="item in navigation"
            :key="item.name"
            :to="item.to"
            active-class="bg-gray-900 text-white"
            :class="[
              this.$route.name === item.to.name
                ? ''
                : 'text-gray-300 hover:bg-gray-700 hover:text-white', 'block rounded-md px-3 py-2 text-base font-medium'
              ]">
            {{ item.name }}
          </router-link>
        </div>

        <!-- Profile (mobile) -->
        <div class="pt-4 pb-3 border-t border-gray-700">
          <div class="flex items-center px-5">
            <div class="flex-shrink-0">
              <a :href="user.github" title="my GitHub page" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-8 w-8" fill="none"
                     viewBox="0 0 24 24" stroke="white">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
              </a>
            </div>
            <div class="ml-3">
              <div class="text-base font-medium leading-none text-white">
                {{ user.name }}
              </div>
              <div class="text-sm font-medium leading-none text-gray-400">
                {{ user.email }}
              </div>
            </div>
          </div>
        </div>
        <!-- / Profile (mobile) -->

      </DisclosurePanel>
    </Disclosure>

    <router-view :key="$route.path"/>

    <Notification/>
  </div>
</template>

<script>
import {Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton} from '@headlessui/vue'
import {Bars3Icon, XMarkIcon} from '@heroicons/vue/24/outline'
import Notification from "./Notification.vue";
import {computed} from "vue";
import {useStore} from "vuex";

const navigation = [
  {name: 'About', to: {name: 'About'}},
  {name: 'Properties', to: {name: 'Properties'}},
]

export default {
  components: {
    Notification,
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Menu,
    MenuButton,
    Bars3Icon,
    XMarkIcon,
  },
  setup() {
    const store = useStore();
    return {
      user: computed(() => store.state.user.data),
      navigation,
    };
  },
};
</script>
