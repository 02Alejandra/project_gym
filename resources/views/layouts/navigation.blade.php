<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800"  />
                        <!-- Logo imgem.img para cologarlo -->
                    </a>
                </div>

                @php
                $module_operator = ['operator', 'administrator'];
                $module_security = ['administrator'];
                $module_store = ['user', 'administrator','operator'];
                $module_audit = ['auditor'];
                $module_admin = ['administrator'];
                $module_employee = ['employee', 'administrator','operator'];
                $module_partner = ['partner', 'administrator'];
        

                @endphp

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>

                <!-- roles -->
                @if (Gate::allows('has_role', [$module_security]))
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <li class="nav-item dropdown list-unstyled">
                        <a href="#" class=" btn " style="margin-top:15px" data-toggle="dropdown">
                            {{ __('Usuarios') }}
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                    <x-nav-link :href="route('role.index')" :active="request()->routeIs('index')">
                                        {{ __('Roles') }}
                                    </x-nav-link>
                                </div>
                            </li>
                            <li>
                                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                    <x-nav-link :href="route('user.index')" :active="request()->routeIs('index')">
                                        {{ __('Usuarios') }}
                                    </x-nav-link>
                                </div>
                            </li>
                            <li>
                                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('index')">
                                        {{ __('Reporte') }}
                                    </x-nav-link>
                                </div>
                            </li>
                        </ul>
                    </li>
                </div>

                @endif

                <!-- empleados -->
                @if (Gate::allows('has_role', [$module_store]))
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <li class="nav-item dropdown list-unstyled">
                        <a href="#" class=" btn " style="margin-top:15px" data-toggle="dropdown">
                            {{ __('Empleados') }}
                        </a>

                        <ul class="dropdown-menu">

                            <li>
                                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                    <x-nav-link :href="route('employee.index')" :active="request()->routeIs('index')">
                                        {{ __('Empleados') }}
                                    </x-nav-link>
                                </div>
                            </li>
                            @if (Gate::allows('has_role', [$module_employee]))
                            <li>
                                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                    <x-nav-link :href="route('occupation.index')" :active="request()->routeIs('index')">
                                        {{ __('Ocupaciones') }}
                                    </x-nav-link>
                                </div>
                            </li>
                            @endif
                           
                            <li>
                                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('index')">
                                        {{ __('Reporte') }}
                                    </x-nav-link>
                                </div>
                            </li>
                           

                        </ul>
                    </li>
                </div>
                @endif
               <!-- Modulo CLientas -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <li class="nav-item dropdown list-unstyled">
                        <a href="#" class=" btn " style="margin-top:15px" data-toggle="dropdown">
                            {{ __('Clientas') }}
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                    <x-nav-link :href="route('partners.index')" :active="request()->routeIs('index')">
                                        {{ __('Clientas') }}
                                    </x-nav-link>
                                </div>
                            </li>   
                            <li>
                                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                    <x-nav-link :href="route('healthCards.index')" :active="request()->routeIs('index')">
                                        {{ __('Ficha de Salud') }}
                                    </x-nav-link>
                                </div>
                            </li>                  
                        </ul>
                    </li>
                </div>
               <!-- Modulo Tipos de Suscripcion -->
               <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <li class="nav-item dropdown list-unstyled">
                        <a href="#" class=" btn " style="margin-top:15px" data-toggle="dropdown">
                            {{ __('Membresía') }}
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                    <x-nav-link :href="route('subscriptionTypes.index')" :active="request()->routeIs('index')">
                                        {{ __('Tipos') }}
                                    </x-nav-link>
                                </div>
                            </li>
                            <li>
                                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                    <x-nav-link :href="route('subscriptions.index')" :active="request()->routeIs('index')">
                                        {{ __('Membresía') }}
                                    </x-nav-link>
                                </div>
                            </li>             

                        </ul>
                    </li>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <li class="nav-item dropdown list-unstyled">
                        <a href="#" class=" btn " style="margin-top:15px" data-toggle="dropdown">
                            {{ __('Inventario') }}
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                    <x-nav-link :href="route('inventories.index')" :active="request()->routeIs('index')">
                                        {{ __('Máquinas') }}
                                    </x-nav-link>
                                </div>
                            </li>                  
                        </ul>
                    </li>
                </div>
            </div>
            
            <!-- audit_trail -->
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <li class="nav-item dropdown list-unstyled">
                        <a href="#" class=" btn " style="margin-top:15px" data-toggle="dropdown">
                            {{ __('Auditoria') }}
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                    <x-nav-link :href="route('audit_trail.index')" :active="request()->routeIs('index')">
                                        {{ __('Registro de auditoria') }}
                                    </x-nav-link>
                                </div>
                            </li>
                            <li>
                                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                    <x-nav-link :href="route('audit_trail.user_actions')" :active="request()->routeIs('user_actions')">
                                        {{ __('Escala Likert') }}
                                    </x-nav-link>
                                </div>
                            </li>                        
                        </ul>
                    </li>
                </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <!-- <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div> -->
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Perfil') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Cerrar Sesion') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Perfil') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Cerrar Sesion') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>