<script setup>
import { LayoutDashboard, ClipboardPen, User, ClipboardSignature, LogOut } from 'lucide-vue-next';
import DropdownLink from '@/Components/DropdownLink.vue';
</script>

<template>
    <aside id="default-sidebar" class="w-2/5 p-12  h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
        <div class="h-full p-10 overflow-y-auto bg-white rounded-xl dark:bg-gray-800">
            <div class="flex flex-row align-middle items-center pb-10">
                <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="50" height="50" rx="13" fill="#FFD4B5"/>
                    <path d="M34.993 20.8217C34.9978 20.7585 34.9978 20.695 34.993 20.6318V20.6318L32.9937 15.6324C32.9156 15.4348 32.7766 15.2672 32.5969 15.1539C32.4171 15.0406 32.206 14.9876 31.994 15.0025H17.9989C17.7987 15.0023 17.6031 15.0622 17.4373 15.1745C17.2716 15.2868 17.1434 15.4463 17.0693 15.6324L15.07 20.6318C15.0652 20.695 15.0652 20.7585 15.07 20.8217C15.0368 20.8774 15.0131 20.9382 15 21.0017V21.0017C15.0111 21.6929 15.2012 22.3693 15.5516 22.9652C15.9019 23.561 16.4007 24.0558 16.9993 24.4013V34.0001C16.9993 34.2653 17.1046 34.5196 17.2921 34.7071C17.4796 34.8947 17.7338 35 17.9989 35H31.994C32.2592 35 32.5134 34.8947 32.7009 34.7071C32.8884 34.5196 32.9937 34.2653 32.9937 34.0001V24.4413C33.598 24.0923 34.1005 23.5912 34.4513 22.9878C34.802 22.3844 34.9888 21.6997 34.993 21.0017V21.0017C35.0023 20.9421 35.0023 20.8814 34.993 20.8217V20.8217ZM25.9961 33.0002H23.9968V29.0007H25.9961V33.0002ZM30.9944 33.0002H27.9954V28.0009C27.9954 27.7357 27.8901 27.4814 27.7026 27.2938C27.5152 27.1063 27.2609 27.001 26.9958 27.001H22.9972C22.7321 27.001 22.4778 27.1063 22.2903 27.2938C22.1029 27.4814 21.9975 27.7357 21.9975 28.0009V33.0002H18.9986V25.0012C19.5679 24.998 20.1299 24.8733 20.6471 24.6353C21.1643 24.3973 21.6247 24.0517 21.9975 23.6214C22.3728 24.047 22.8343 24.3878 23.3513 24.6213C23.8684 24.8547 24.4292 24.9755 24.9965 24.9755C25.5638 24.9755 26.1246 24.8547 26.6417 24.6213C27.1587 24.3878 27.6202 24.047 27.9954 23.6214C28.3683 24.0517 28.8287 24.3973 29.3459 24.6353C29.8631 24.8733 30.4251 24.998 30.9944 25.0012V33.0002ZM30.9944 23.0015C30.4641 23.0015 29.9556 22.7908 29.5807 22.4158C29.2057 22.0407 28.9951 21.5321 28.9951 21.0017C28.9951 20.7365 28.8898 20.4822 28.7023 20.2947C28.5148 20.1072 28.2606 20.0018 27.9954 20.0018C27.7303 20.0018 27.476 20.1072 27.2886 20.2947C27.1011 20.4822 26.9958 20.7365 26.9958 21.0017C26.9958 21.5321 26.7851 22.0407 26.4102 22.4158C26.0353 22.7908 25.5267 23.0015 24.9965 23.0015C24.4662 23.0015 23.9577 22.7908 23.5828 22.4158C23.2078 22.0407 22.9972 21.5321 22.9972 21.0017C22.9972 20.7365 22.8919 20.4822 22.7044 20.2947C22.5169 20.1072 22.2627 20.0018 21.9975 20.0018C21.7324 20.0018 21.4782 20.1072 21.2907 20.2947C21.1032 20.4822 20.9979 20.7365 20.9979 21.0017C21.0077 21.2643 20.9658 21.5263 20.8744 21.7727C20.783 22.0191 20.644 22.2451 20.4653 22.4377C20.2866 22.6304 20.0718 22.7859 19.833 22.8955C19.5942 23.0051 19.3361 23.0666 19.0736 23.0765C18.5433 23.0964 18.0269 22.9047 17.6379 22.5438C17.4453 22.365 17.2897 22.1501 17.1802 21.9113C17.0706 21.6724 17.0091 21.4143 16.9993 21.1517L18.6787 17.0022H31.3143L32.9937 21.1517C32.9558 21.6557 32.7285 22.1266 32.3576 22.4697C31.9867 22.8129 31.4996 23.0029 30.9944 23.0015V23.0015Z" fill="#0D0D0D"/>
                </svg>
                <p class="text-md p-2">GSO-Marketplace</p>
            </div>
            <ul class="space-y-2 font-medium">
                <li>
                    <a :href="route('dashboard')" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <LayoutDashboard
                            color="black"
                            size="24"
                        />
                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a :href="route('dashboard')"  class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <ClipboardPen
                            color="black"
                            size="24"
                        />
                        <span class="flex-1 ms-3 whitespace-nowrap">Reports Generieren</span>
                    </a>
                </li>
                <li>
                    <a :href="route('profile.edit')" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <User
                            color="black"
                            size="24"
                        />
                        <span class="flex-1 ms-3 whitespace-nowrap">Profil</span>
                    </a>
                </li>
                <li>
                    <a :href="route('dashboard')" methods="post"  class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <ClipboardSignature
                            color="black"
                            size="24"
                        />
                        <span class="flex-1 ms-3 whitespace-nowrap">Anmeldungen</span>
                    </a>
                </li>
                <li>
                    <DropdownLink :href="route('logout')" method="post" as="button">
                        <LogOut
                            color="black"
                            size="24"
                        />
                        Log Out
                    </DropdownLink>
                </li>

            </ul>
        </div>
    </aside>


</template>

<style scoped>

</style>
