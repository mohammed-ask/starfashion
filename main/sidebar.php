<!-- Desktop sidebar -->
<aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
  <div class="py-4 text-gray-500 dark:text-gray-400">
    <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
      <img src="main/images/indstock.png" style="margin-left: 25px; margin-top: -45px; margin-bottom: 10px; width:145px" alt="logo">
    </a>

    <ul>
      <li class="relative px-6 py-3">
        <a class="inline-flex items-center w-full  font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="<?= $_SESSION['type'] == 1 ? 'administrator' : 'dashboard' ?>">
          <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
            <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
            </path>
          </svg>
          <span class="ml-3">Dashboard</span>
        </a>
      </li>
    </ul>
    <?php if (in_array(31, $permissions)) { ?>
      <ul>
        <li class="relative px-6 py-3">
          <a class="inline-flex items-center w-full  font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="requestwithdrawal">
            <i class="fas fa-rupee-sign"></i>
            <span class="ml-3">Request Withdrawal</span>
          </a>
        </li>
      </ul>
    <?php } ?>
    <?php if (in_array(15, $permissions) || in_array(16, $permissions) || in_array(17, $permissions)) { ?>
      <li class="relative px-6 py-3">
        <button class="inline-flex items-center justify-between w-full  font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" @click="togglePagesMenu" aria-haspopup="true">
          <span class="inline-flex items-center">
            <span class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
              <i class="fa-solid fa-envelope"></i>
            </span>
            <span class="ml-3">EMail</span>
          </span>
          <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
          </svg>
        </button>
        <template x-if="isPagesMenuOpen">
          <ul x-transition:enter="transition-all ease-in-out duration-300" x-transition:enter-start="opacity-25 max-h-0" x-transition:enter-end="opacity-100 max-h-xl" x-transition:leave="transition-all ease-in-out duration-300" x-transition:leave-start="opacity-100 max-h-xl" x-transition:leave-end="opacity-0 max-h-0" class="p-2 mt-2 space-y-2 overflow-hidden  font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900" aria-label="submenu">
            <?php if (in_array(15, $permissions)) { ?>
              <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                <a class="w-full" href="composemail">Compose Mail</a>
              </li>
            <?php } ?>
            <?php if (in_array(16, $permissions)) { ?>
              <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                <a class="w-full" href="viewinbox">
                  Inbox
                </a>
              </li>
            <?php } ?>
            <?php if (in_array(17, $permissions)) { ?>
              <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                <a class="w-full" href="sentmails">
                  Sent Mail
                </a>
              </li>
            <?php } ?>
          </ul>
        </template>
      </li>
    <?php } ?>
    <div class="px-6 my-6">
      <button class="flex items-center justify-between w-full px-4 py-2  font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
        Create account
        <span class="ml-2" aria-hidden="true">+</span>
      </button>
    </div>
  </div>
</aside>
<!-- Mobile sidebar -->
<div x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"></div>
<aside class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white dark:bg-gray-800 md:hidden" x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150" x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenu" @keydown.escape="closeSideMenu">
  <div class="py-4 text-gray-500 dark:text-gray-400">
    <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
      <img src="main/images/indstock.png" style="margin-left: 25px; margin-top: -45px; margin-bottom: 10px; width:200px" alt="logo">
    </a>

    <ul>
      <li class="relative px-6 py-3">
        <a class="inline-flex items-center w-full  font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="administrator">
          <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
            <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
            </path>
          </svg>
          <span class="ml-3">Dashboard</span>
        </a>
      </li>
    </ul>
    <ul>

      <li class="relative px-6 py-3">
        <button class="inline-flex items-center justify-between w-full  font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" @click="toggleOverviewPagesMenu" aria-haspopup="true">
          <span class="inline-flex items-center">
            <span class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
              <i class="fa-solid fa-user"></i>
            </span>
            <span class="ml-3">Users Overview</span>
          </span>
          <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
          </svg>
        </button>
        <template x-if="isOverviewPagesMenuOpen">
          <ul x-transition:enter="transition-all ease-in-out duration-300" x-transition:enter-start="opacity-25 max-h-0" x-transition:enter-end="opacity-100 max-h-xl" x-transition:leave="transition-all ease-in-out duration-300" x-transition:leave-start="opacity-100 max-h-xl" x-transition:leave-end="opacity-0 max-h-0" class="p-2 mt-2 space-y-2 overflow-hidden  font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900" aria-label="submenu">
            <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
              <a class="w-full" href="users">Users List</a>
            </li>
            <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
              <a class="w-full" href="userlogindetails">
                Logins Time Details
              </a>
            </li>
          </ul>
        </template>
      </li>
      <li class="relative px-6 py-3">
        <button class="inline-flex items-center justify-between w-full  font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" @click="toggleRolePagesMenu" aria-haspopup="true">
          <span class="inline-flex items-center">
            <span class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
              <i class="fa-solid fa-users-gear"></i>
            </span>
            <span class="ml-3">Role Management</span>
          </span>
          <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
          </svg>
        </button>
        <template x-if="isRolePagesMenuOpen">
          <ul x-transition:enter="transition-all ease-in-out duration-300" x-transition:enter-start="opacity-25 max-h-0" x-transition:enter-end="opacity-100 max-h-xl" x-transition:leave="transition-all ease-in-out duration-300" x-transition:leave-start="opacity-100 max-h-xl" x-transition:leave-end="opacity-0 max-h-0" class="p-2 mt-2 space-y-2 overflow-hidden  font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900" aria-label="submenu">
            <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
              <a class="w-full" href="viewrole">Roles</a>
            </li>
            <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
              <a class="w-full" href="permission">Permissions</a>
            </li>
          </ul>
        </template>
      </li>
      <li class="relative px-6 py-3">
        <button class="inline-flex items-center justify-between w-full  font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" @click="toggleTransectionMenu" aria-haspopup="true">
          <span class="inline-flex items-center">
            <span class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
              <i class="fa-solid fa-money-bill-transfer"></i>
            </span>
            <span class="ml-3">Transactions</span>
          </span>
          <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
          </svg>
        </button>
        <template x-if="isTransectionMenuOpen">
          <ul x-transition:enter="transition-all ease-in-out duration-300" x-transition:enter-start="opacity-25 max-h-0" x-transition:enter-end="opacity-100 max-h-xl" x-transition:leave="transition-all ease-in-out duration-300" x-transition:leave-start="opacity-100 max-h-xl" x-transition:leave-end="opacity-0 max-h-0" class="p-2 mt-2 space-y-2 overflow-hidden  font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900" aria-label="submenu">
            <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
              <a class="w-full" href="todaytransactions.html">Today's Transactions</a>
            </li>
            <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
              <a class="w-full" href="alltransactions.html">
                All Transactions
              </a>
            </li>
          </ul>
        </template>
      </li>
      <li class="relative px-6 py-3">
        <button class="inline-flex items-center justify-between w-full  font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" @click="togglePagesMenu" aria-haspopup="true">
          <span class="inline-flex items-center">
            <span class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
              <i class="fa-solid fa-envelope"></i>
            </span>
            <span class="ml-3">EMail</span>
          </span>
          <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
          </svg>
        </button>
        <template x-if="isPagesMenuOpen">
          <ul x-transition:enter="transition-all ease-in-out duration-300" x-transition:enter-start="opacity-25 max-h-0" x-transition:enter-end="opacity-100 max-h-xl" x-transition:leave="transition-all ease-in-out duration-300" x-transition:leave-start="opacity-100 max-h-xl" x-transition:leave-end="opacity-0 max-h-0" class="p-2 mt-2 space-y-2 overflow-hidden  font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900" aria-label="submenu">
            <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
              <a class="w-full" href="composemail">Compose Mail</a>
            </li>
            <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
              <a class="w-full" href="viewinbox">
                Inbox
              </a>
            </li>
            <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
              <a class="w-full" href="sentmails">
                Sent Mail
              </a>
            </li>
          </ul>
        </template>
      </li>

      <ul>
        <li class="relative px-6 py-3">
          <a class="inline-flex items-center w-full  font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="pendingapproval">
            <i class="fa-solid fa-user-clock"></i>
            <span class="ml-3">Pending Approvals</span>
          </a>
        </li>
      </ul>
      <li class="relative px-6 py-3">
        <button class="inline-flex items-center justify-between w-full  font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" @click="toggleInvestmentPageMenu" aria-haspopup="true">
          <span class="inline-flex items-center">
            <span class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
              <i class="fa-solid fa-indian-rupee-sign"></i>
            </span>
            <span class="ml-3">Investment</span>
          </span>
          <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
          </svg>
        </button>
        <template x-if="isInvestmentPageMenuOpen">
          <ul x-transition:enter="transition-all ease-in-out duration-300" x-transition:enter-start="opacity-25 max-h-0" x-transition:enter-end="opacity-100 max-h-xl" x-transition:leave="transition-all ease-in-out duration-300" x-transition:leave-start="opacity-100 max-h-xl" x-transition:leave-end="opacity-0 max-h-0" class="p-2 mt-2 space-y-2 overflow-hidden  font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900" aria-label="submenu">
            <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
              <a class="w-full" href="allinvestment">All</a>
            </li>
            <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
              <a class="w-full" href="pendinginvestment">Pending</a>
            </li>
            <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
              <a class="w-full" href="approvedinvestment">Approved</a>
            </li>
            <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
              <a class="w-full" href="disapprovedinvestment">Disapproved</a>
            </li>
            <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
              <a class="w-full" href="withdrawalrequest">Withdrawal Requests</a>
            </li>
          </ul>
        </template>
      </li>
      <ul>
        <li class="relative px-6 py-3">
          <a class="inline-flex items-center w-full  font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="employeelist">
            <i class="fa-solid fa-circle-info"></i>
            <span class="ml-3">Employees Details</span>
          </a>
        </li>
      </ul>
      <ul>
        <li class="relative px-6 py-3">
          <a class="inline-flex items-center w-full  font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="settings">
            <i class="fa fa-cog fa-lg"></i>
            <span class="ml-3">Settings</span>
          </a>
        </li>
      </ul>
    </ul>
    <div class="px-6 my-6">
      <button class="flex items-center justify-between w-full px-4 py-2  font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
        Create account
        <span class="ml-2" aria-hidden="true">+</span>
      </button>
    </div>
  </div>
</aside>