<template>
    <header
        class="bg-transparent fixed top-0 left-0 w-full flex items-center z-50 py-2 font-sans"
    >
        <div class="container mx-auto px-4 pt-5">
            <div class="flex items-center justify-between relative w-full">
                <!-- Logo and text for larger screens -->
                <div class="shrink-0 flex items-center mx-10 mt-2 lg:mt-0">
                    <Link :href="route('dashboard')" class="gede">
                        <ApplicationLogo
                            class="block w-auto h-16 fill-current text-gray-800"
                        />
                    </Link>
                    <span
                        class="ml-5 text-white font-semibold text-lg hidden lg:inline"
                    >
                        Dinas Perpustakaan Dan Kearsipan <br />
                        DKI JAKARTA
                    </span>
                </div>
                <!-- Hamburger button for mobile screens -->
                <div class="flex items-center lg:hidden relative z-50">
                    <button
                        id="hamburger"
                        name="hamburger"
                        type="button"
                        class="block font-bold"
                        @click="toggleNavbarMenu"
                    >
                        <span
                            class="hamburger-line transition duration-300 ease-in-out origin-top-left"
                        ></span>
                        <span
                            class="hamburger-line transition duration-300 ease-in-out"
                        ></span>
                        <span
                            class="hamburger-line transition duration-300 ease-in-out origin-bottom-left"
                        ></span>
                    </button>
                </div>
                <!-- Navbar menu for all screens -->
                <nav
                    id="navbar-menu"
                    class="hidden lg:flex items-center w-full lg:w-auto bg-opacity-0 absolute top-0 right-0"
                >
                    <ul
                        class="block lg:flex lg:space-x-4 w-full lg:w-auto lg:bg-transparent bg-white backdrop-filter backdrop-blur-lg bg-opacity-10 rounded-lg"
                    >
                        <li class="group">
                            <a
                                href="/login"
                                class="text-base text-white font-bold py-2 mx-2 lg:mx-4 flex group-hover:text-Orange"
                                >Login</a
                            >
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- Logo and text for mobile screens -->
            <div id="mobile-logo" class="hidden lg:hidden mt-5 items-center">
                <Link :href="route('dashboard')">
                    <ApplicationLogo
                        class="block w-auto h-16 fill-current text-gray-800"
                    />
                </Link>
                <span class="ml-5 text-white font-semibold text-lg">
                    Dinas Perpustakaan Dan Kearsipan <br />
                    Kota Jakarta Selatan
                </span>
            </div>
        </div>
    </header>
</template>

<script>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";

export default {
    components: {
        ApplicationLogo,
        Link,
    },
    methods: {
        toggleNavbarMenu() {
            const navbarMenu = document.getElementById("navbar-menu");
            const mobileLogo = document.getElementById("mobile-logo");

            navbarMenu.classList.toggle("hidden");
            document.body.classList.toggle("overflow-hidden"); // Optional: Disable scrolling when menu is open
            mobileLogo.classList.toggle("hidden");
        },

        closeNavbarMenu(event) {
            const navbarMenu = document.getElementById("navbar-menu");
            const hamburger = document.getElementById("hamburger");
            const mobileLogo = document.getElementById("mobile-logo");

            const isClickInsideNavbar = navbarMenu.contains(event.target);
            const isClickOnHamburger = hamburger.contains(event.target);

            if (
                !isClickInsideNavbar &&
                !isClickOnHamburger &&
                !navbarMenu.classList.contains("hidden")
            ) {
                navbarMenu.classList.add("hidden");
                document.body.classList.remove("overflow-hidden"); // Optional: Enable scrolling
                hamburger.classList.remove("hamburger-active");
                mobileLogo.classList.remove("hidden");
            }
        },
    },

    mounted() {
        document.addEventListener("click", this.closeNavbarMenu);
    },

    beforeUnmount() {
        document.removeEventListener("click", this.closeNavbarMenu);
    },
};
</script>

<style>
.hamburger-line {
    @apply w-[30px] h-[2px] my-1 block bg-white;
}

#navbar-menu {
    @apply lg:static absolute top-0 right-0 w-full lg:w-auto text-right;
}
#navbar-menu ul {
    @apply lg:flex flex-col lg:flex-row items-center justify-center;
}
#navbar-menu ul li {
    @apply lg:my-0 my-2;
}
#mobile-logo {
    @apply mt-5 items-center flex;
    display: none; /* Hide by default on all screens */
}
@media (max-width: 767px) {
    .gede {
        display: none;
    }
    .lg\\:hidden {
        display: none !important; /* Hide lg:hidden elements on small screens */
    }
    #mobile-logo {
        display: flex; /* Show on small screens */
    }
    #navbar-menu {
        position: absolute;
        padding-top: 20px; /* Reset position for mobile view */
        text-align: justify;
    }
}
</style>
