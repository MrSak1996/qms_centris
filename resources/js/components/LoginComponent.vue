<template>
    <div class="container-scroller">
        <header>
            <nav class="navbar navbar-expand-md navbar-dark fixed-top navscroll" style="background-color: #1e1e2d;">
                <div class="container-fluid">
                    <router-link class="navbar-brand" to="/">Your Brand</router-link>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                        aria-label="Toggle navigation" @click="toggleNavbar">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" :class="{ 'show': isNavbarOpen }" id="navbarCollapse">
                        <ul class="navbar-nav me-auto mb-2 mb-md-0">
                            <li class="nav-item">
                                <router-link class="nav-link" :to="{ path: '/' }" exact>Home</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link class="nav-link" :to="{ path: '/guidelines' }"
                                    active-class="active">Guidelines</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link class="nav-link" :to="{ path: '/registration' }"
                                    active-class="active">Quality Procedures</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link class="nav-link" :to="{ path: '/certified-establishments' }"
                                    active-class="active">Process Owners</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link class="nav-link" :to="{ path: '/inspection-and-certification-team' }"
                                    active-class="active">Reports Submission</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link class="nav-link" :to="{ path: '/sign-in' }"
                                    active-class="active">Log-in</router-link>
                            </li>
                        </ul>

                    </div>
                </div>
            </nav>
        </header>
        <img :src="header" class="mt-5" />
        <div class="main-page">
            <div class="section-1 text-center">
                <h5 class="fs-3 fw-bold text-white my-4 py-2 mt-5 text-center" style="font-size:2rem;">WELCOME TO</h5>
                <h1 class="fs-12 fw-bolder text-white text-center"
                    style="font-size:5rem;font-weight:bolder;margin-top:-10px;">QMS CENTRIS</h1>
                <h5 class="fs-5 fw-light text-white text-center" style="font-size:2rem;">ONLINE SYSTEM</h5>
                <div class="container">

                    <!-- <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    
                                </div>
                            </div>
                        </div>

                    </div> -->
                </div>





            </div>
        </div>

        <!-- <div class="container bg-light" style="padding-top:10px;">
            <div class="row mb-4">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3">
                                    <SelectInput label="Select Year" v-model="selectedMode">
                                        <option value="2024" data-id="2024" data-value="2024">2024</option>
                                        <option value="2025" data-id="2025" data-value="2025">2025</option>
                                        <option value="2026" data-id="2026" data-value="2026">2026</option>
                                        <option value="2027" data-id="2027" data-value="2027">2027</option>
                                        <option value="2087" data-id="2028" data-value="2028">2028</option>
                                        <option value="2097" data-id="2029" data-value="2029">2029</option>
                                        <option value="2307" data-id="2030" data-value="2030">2030</option>
                                       
                                    </SelectInput>
                                </div>
                                <div class="col-lg-3">
                                    <SelectInput label="Frequency of Monitoring" v-model="selectedMode">
                                        <option value="Yearly" data-id="Yearly" data-value="1">Yearly</option>
                                        <option value="Quarterly" data-id="Quarterly" data-value="1">Quarterly</option>
                                        <option value="Monthly" data-id="Monthly" data-value="Monthly">Yearly</option>
                                    </SelectInput>
                                </div>
                                <div class="col-lg-3">
                                    <SelectInput label="Quality Policy Code" v-model="selectedMode">
                                        <option value="1" data-id="Small Value Procurement" data-value="1">Small Value
                                            Procu
                                            rement</option>
                                        <option value="2" data-id="Shopping" data-value="2">Shopping</option>
                                        <option value="4" data-id="NP Lease of Venue" data-value="4">NP Lease of Venue
                                        </option>
                                        <option value="5" data-id="Direct Contracting" data-value="5">Direct Contracting
                                        </option>
                                        <option value="6" data-id="Agency to Agency" data-value="6">Agency to Agency
                                        </option>
                                        <option value="7" data-id="Public Bidding" data-value="7">Public Bidding
                                        </option>
                                        <option value="8" data-id="Not Applicable N/A" data-value="8">Not Applicable N/A
                                        </option>
                                    </SelectInput>
                                </div>
                                <div class="col-lg-3">
                                    <button class="btn btn-outline-primary btn-fw btn-icon-text mx-2 mt-4 col-lg-12" >Filter</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body mt-5">
                            <div class="d-flex justify-content-between">
                                <p class="card-title">Quality Procedures Statistics</p>
                                <a href="#" class="text-info">View all</a>
                            </div>
                            <p class="font-weight-500">Description: The total number of sessions within the date range.
                                It
                                is the
                                period time a user is actively engaged with your website, page or app, etc</p>
                            <div id="sales-legend" class="chartjs-legend mt-4 mb-2"></div>
                            <canvas id="sales-chart"></canvas>

                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card card_shadow mt-4">
                        <div class="card-body">
                            <div id="detailedReports"
                                class="carousel slide detailed-report-carousel position-static pt-2"
                                data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="row">
                                            <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                                                <div class="ml-xl-4 mt-3">
                                                    <p class="card-title">Detailed Reports</p>
                                                    <h1 class="text-primary">$34040</h1>
                                                    <h3 class="font-weight-500 mb-xl-4 text-primary">North America
                                                    </h3>
                                                    <p class="mb-2 mb-xl-0">The total number of sessions within the
                                                        date range. It is the period time a user is actively engaged
                                                        with your website, page or app, etc</p>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-xl-9">
                                                <div class="row">
                                                    <div class="col-md-6 border-right">
                                                        <div class="table-responsive mb-3 mb-md-0 mt-3">
                                                            <table class="table table-borderless report-table">
                                                                <tr>
                                                                    <td class="text-muted">Illinois</td>
                                                                    <td class="w-100 px-0">
                                                                        <div class="progress progress-md mx-4">
                                                                            <div class="progress-bar bg-primary"
                                                                                role="progressbar" style="width: 70%"
                                                                                aria-valuenow="70" aria-valuemin="0"
                                                                                aria-valuemax="100"></div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <h5 class="font-weight-bold mb-0">713</h5>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-muted">Washington</td>
                                                                    <td class="w-100 px-0">
                                                                        <div class="progress progress-md mx-4">
                                                                            <div class="progress-bar bg-warning"
                                                                                role="progressbar" style="width: 30%"
                                                                                aria-valuenow="30" aria-valuemin="0"
                                                                                aria-valuemax="100"></div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <h5 class="font-weight-bold mb-0">583</h5>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-muted">Mississippi</td>
                                                                    <td class="w-100 px-0">
                                                                        <div class="progress progress-md mx-4">
                                                                            <div class="progress-bar bg-danger"
                                                                                role="progressbar" style="width: 95%"
                                                                                aria-valuenow="95" aria-valuemin="0"
                                                                                aria-valuemax="100"></div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <h5 class="font-weight-bold mb-0">924</h5>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-muted">California</td>
                                                                    <td class="w-100 px-0">
                                                                        <div class="progress progress-md mx-4">
                                                                            <div class="progress-bar bg-info"
                                                                                role="progressbar" style="width: 60%"
                                                                                aria-valuenow="60" aria-valuemin="0"
                                                                                aria-valuemax="100"></div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <h5 class="font-weight-bold mb-0">664</h5>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-muted">Maryland</td>
                                                                    <td class="w-100 px-0">
                                                                        <div class="progress progress-md mx-4">
                                                                            <div class="progress-bar bg-primary"
                                                                                role="progressbar" style="width: 40%"
                                                                                aria-valuenow="40" aria-valuemin="0"
                                                                                aria-valuemax="100"></div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <h5 class="font-weight-bold mb-0">560</h5>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-muted">Alaska</td>
                                                                    <td class="w-100 px-0">
                                                                        <div class="progress progress-md mx-4">
                                                                            <div class="progress-bar bg-danger"
                                                                                role="progressbar" style="width: 75%"
                                                                                aria-valuenow="75" aria-valuemin="0"
                                                                                aria-valuemax="100"></div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <h5 class="font-weight-bold mb-0">793</h5>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mt-3">
                                                        <canvas id="north-america-chart"></canvas>
                                                        <div id="north-america-legend"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="row">
                                            <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                                                <div class="ml-xl-4 mt-3">
                                                    <p class="card-title">Detailed Reports</p>
                                                    <h1 class="text-primary">$34040</h1>
                                                    <h3 class="font-weight-500 mb-xl-4 text-primary">North America
                                                    </h3>
                                                    <p class="mb-2 mb-xl-0">The total number of sessions within the
                                                        date range. It is the period time a user is actively engaged
                                                        with your website, page or app, etc</p>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-xl-9">
                                                <div class="row">
                                                    <div class="col-md-6 border-right">
                                                        <div class="table-responsive mb-3 mb-md-0 mt-3">
                                                            <table class="table table-borderless report-table">
                                                                <tr>
                                                                    <td class="text-muted">Illinois</td>
                                                                    <td class="w-100 px-0">
                                                                        <div class="progress progress-md mx-4">
                                                                            <div class="progress-bar bg-primary"
                                                                                role="progressbar" style="width: 70%"
                                                                                aria-valuenow="70" aria-valuemin="0"
                                                                                aria-valuemax="100"></div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <h5 class="font-weight-bold mb-0">713</h5>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-muted">Washington</td>
                                                                    <td class="w-100 px-0">
                                                                        <div class="progress progress-md mx-4">
                                                                            <div class="progress-bar bg-warning"
                                                                                role="progressbar" style="width: 30%"
                                                                                aria-valuenow="30" aria-valuemin="0"
                                                                                aria-valuemax="100"></div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <h5 class="font-weight-bold mb-0">583</h5>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-muted">Mississippi</td>
                                                                    <td class="w-100 px-0">
                                                                        <div class="progress progress-md mx-4">
                                                                            <div class="progress-bar bg-danger"
                                                                                role="progressbar" style="width: 95%"
                                                                                aria-valuenow="95" aria-valuemin="0"
                                                                                aria-valuemax="100"></div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <h5 class="font-weight-bold mb-0">924</h5>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-muted">California</td>
                                                                    <td class="w-100 px-0">
                                                                        <div class="progress progress-md mx-4">
                                                                            <div class="progress-bar bg-info"
                                                                                role="progressbar" style="width: 60%"
                                                                                aria-valuenow="60" aria-valuemin="0"
                                                                                aria-valuemax="100"></div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <h5 class="font-weight-bold mb-0">664</h5>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-muted">Maryland</td>
                                                                    <td class="w-100 px-0">
                                                                        <div class="progress progress-md mx-4">
                                                                            <div class="progress-bar bg-primary"
                                                                                role="progressbar" style="width: 40%"
                                                                                aria-valuenow="40" aria-valuemin="0"
                                                                                aria-valuemax="100"></div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <h5 class="font-weight-bold mb-0">560</h5>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-muted">Alaska</td>
                                                                    <td class="w-100 px-0">
                                                                        <div class="progress progress-md mx-4">
                                                                            <div class="progress-bar bg-danger"
                                                                                role="progressbar" style="width: 75%"
                                                                                aria-valuenow="75" aria-valuemin="0"
                                                                                aria-valuemax="100"></div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <h5 class="font-weight-bold mb-0">793</h5>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mt-3">
                                                        <canvas id="south-america-chart"></canvas>
                                                        <div id="south-america-legend"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#detailedReports" role="button"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#detailedReports" role="button"
                                    data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card mt-4">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-4">Total</p>
                                <p class="fs-30 mb-2"> 10</p>
                            </div>
                            <div>
                                <i class="fa-solid fa-users" style="font-size:50px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card mt-4">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-4">Total</p>
                                <p class="fs-30 mb-2"> 10</p>
                            </div>
                            <div>
                                <i class="fa-solid fa-users" style="font-size:50px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card mt-4">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-4">Total</p>
                                <p class="fs-30 mb-2"> 10</p>
                            </div>
                            <div>
                                <i class="fa-solid fa-users" style="font-size:50px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card mt-4">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-4">Total</p>
                                <p class="fs-30 mb-2"> 10</p>
                            </div>
                            <div>
                                <i class="fa-solid fa-users" style="font-size:50px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card mt-4">
                        <div class="card-body">
                            <div id="stat-legend" class="chartjs-legend mt-4 mb-2"></div>
                            <canvas id="stat"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card mt-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <p class="card-title">Quick Statistics</p>
                            </div>
                            <div class="row">

                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Status</th>
                                                    <th>Total</th>
                                                    <th>Ratio</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td>Under Investigation</td>
                                                    <td>1</td>
                                                    <td>100</td>
                                                </tr>

                                                <tr>
                                                    <td>Surrendered</td>
                                                    <td>3</td>
                                                    <td>75</td>
                                                </tr>

                                                <tr>
                                                    <td>Apprehended</td>
                                                    <td>2</td>
                                                    <td>33.33</td>
                                                </tr>

                                                <tr>
                                                    <td>Escaped</td>
                                                    <td>2</td>
                                                    <td>25</td>
                                                </tr>

                                                <tr>
                                                    <td>Deceased</td>
                                                    <td>2</td>
                                                    <td>20</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</template>
<style>
.main-page {
    background-color: #054139;
}
.card {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Horizontal offset, Vertical offset, Blur radius, Spread radius, Color */
}

.section-1 {
    padding-top: 15vh;
    color: white !important;
    font-family: 'Poppins';
    background: linear-gradient(to top, rgba(0, 0, 0, 0.6), rgb(6, 151, 131));
    height: 75vh;
    overflow-y: hidden;
    overflow-x: hidden;
    position: relative;
}

.text-center {
    text-align: center !important;
}



.auth .brand-logo img {
    width: 100% !important;

}

.header-align-center {
    text-align: center;
}
</style>
<script>
import SelectInput from "./micro/SelectInput.vue";

import dilg_banner from "../../../assets/images/login.png";

import banner from "../../../assets/images/banner.png";
import axios from 'axios';
import { toast } from "vue3-toastify";

export default {
    name: 'Login',
    data() {
        return {
            isNavbarOpen: false,
            dilg_banner: dilg_banner,
            header: banner,
            results: {},
            form: {
                email: '',
                password: '',
            },
            errors: []
        }
    },
    mounted() {
        this.renderChart();
        this.renderSalesChart();
        this.renderDetailedReportChart();
    },
    methods: {
        toggleNavbar() {
            this.isNavbarOpen = !this.isNavbarOpen;
        },
        showFailedNotification(message) {
            toast.error(message, {
                autoClose: 1000,
            });
        },
        showSuccessNotification(message) {
            toast.success(message, {
                autoClose: 1000,
            });
        },
        // Login component
        loginUser() {
            axios
                .post('/api/login', this.form)
                .then(response => {
                    if (response.data.status) {
                        //this code is to make user id accessible globally
                        localStorage.setItem('userId', response.data.userId);

                        this.showSuccessNotification('You are logged in');
                        setTimeout(() => {
                            this.$router.push({ name: 'Dashboard' });
                        }, 1000);
                    } else {
                        this.showFailedNotification('Login Failed');
                        // Handle login failure, show error message, etc.
                    }
                })
                .catch(error => {
                    if (error.response && error.response.data) {
                        // Server returned an error response
                        this.errors = error.response.data.errors;
                    } else {
                        // Error occurred during the request
                        console.log(error);
                    }
                });
        },


        renderDetailedReportChart() {
            if ($("#stat").length) {
                var SalesChartCanvas = $("#stat").get(0).getContext("2d");
                var SalesChart = new Chart(SalesChartCanvas, {
                    type: 'horizontalBar',
                    data: {
                        labels: ["REGION I", "REGION II", "REGION III - CENTRAL LUZON", "REGION IV-A", "REGION V - BICOL REGION", "REGION VI - WESTERN VISAYAS", "REGION VII - CENTRAL VISAYAS", "REGION VIII - EASTERN VISAYAS", "REGION IX - ZAMBOANGA PENINSULA", "REGION X - NORTHERN MINDANAO", "REGION XI - DAVAO REGION", "REGION XII - SOCCSSARGEN", "NATIONAL CAPITAL REGION", "CORDILLERA ADMINISTRATIVE REGION", "AUTONOMOUS REGION IN MUSLIM MINDANAO", "REGION XIII - CARAGA", "MIMAROPA"],
                        datasets: [{
                            label: 'Sex',
                            data: [10, 20, 30, 40, 50, 60, 70, 80, 90, 100, 110, 120],

                            backgroundColor: '#98BDFF'
                        },
                        {
                            label: 'Age',
                            data: [480, 230, 470, 24310, 33430, 3433, 230, 4750, 33, 2552, 4580, 736, 4750, 2310, 464, 3544],
                            backgroundColor: '#4B49AC'
                        },
                        {
                            label: 'Total',
                            data: [480, 230, 4470, 2310, 344, 34343, 230, 4750, 2150, 3554, 4545, 2305, 4570, 2434, 33430, 344],
                            backgroundColor: 'rgb(111, 191, 178)'
                        },

                        ]
                    },
                    options: {
                        cornerRadius: 5,
                        responsive: true,
                        maintainAspectRatio: true,
                        layout: {
                            padding: {
                                left: 0,
                                right: 0,
                                top: 20,
                                bottom: 0
                            }
                        },
                        scales: {
                            yAxes: [{
                                display: true,
                                gridLines: {
                                    display: true,
                                    drawBorder: false,
                                    color: "#F2F2F2"
                                },
                                ticks: {
                                    display: true,
                                    min: 0,
                                    max: 20,
                                    callback: function (value, index, values) {
                                        return value;
                                    },
                                    autoSkip: true,
                                    maxTicksLimit: 10,
                                    fontColor: "#6C7383"
                                }
                            }],
                            xAxes: [{
                                stacked: false,
                                ticks: {
                                    beginAtZero: true,
                                    fontColor: "#6C7383"
                                },
                                gridLines: {
                                    color: "rgba(0, 0, 0, 0)",
                                    display: false
                                },
                                barPercentage: 1
                            }]
                        },
                        legend: {
                            display: false
                        },
                        elements: {
                            point: {
                                radius: 0
                            }
                        }
                    },
                });
                document.getElementById('stat-legend').innerHTML = SalesChart.generateLegend();
            }
            if ($("#north-america-chart").length) {
                var areaData = {
                    labels: ["Jan", "Feb", "Mar"],
                    datasets: [{
                        data: [100, 50, 50],
                        backgroundColor: [
                            "#4B49AC", "#FFC100", "#248AFD",
                        ],
                        borderColor: "rgba(0,0,0,0)"
                    }]
                };
                var areaOptions = {
                    responsive: true,
                    maintainAspectRatio: true,
                    segmentShowStroke: false,
                    cutoutPercentage: 78,
                    elements: {
                        arc: {
                            borderWidth: 4
                        }
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        enabled: true
                    },
                    legendCallback: function (chart) {
                        var text = [];
                        text.push('<div class="report-chart">');
                        text.push('<div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center"><div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: ' + chart.data.datasets[0].backgroundColor[0] + '"></div><p class="mb-0">Offline sales</p></div>');
                        text.push('<p class="mb-0">88333</p>');
                        text.push('</div>');
                        text.push('<div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center"><div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: ' + chart.data.datasets[0].backgroundColor[1] + '"></div><p class="mb-0">Online sales</p></div>');
                        text.push('<p class="mb-0">66093</p>');
                        text.push('</div>');
                        text.push('<div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center"><div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: ' + chart.data.datasets[0].backgroundColor[2] + '"></div><p class="mb-0">Returns</p></div>');
                        text.push('<p class="mb-0">39836</p>');
                        text.push('</div>');
                        text.push('</div>');
                        return text.join("");
                    },
                }
                var northAmericaChartPlugins = {
                    beforeDraw: function (chart) {
                        var width = chart.chart.width,
                            height = chart.chart.height,
                            ctx = chart.chart.ctx;

                        ctx.restore();
                        var fontSize = 3.125;
                        ctx.font = "500 " + fontSize + "em sans-serif";
                        ctx.textBaseline = "middle";
                        ctx.fillStyle = "#13381B";

                        var text = "90",
                            textX = Math.round((width - ctx.measureText(text).width) / 2),
                            textY = height / 2;

                        ctx.fillText(text, textX, textY);
                        ctx.save();
                    }
                }
                var northAmericaChartCanvas = $("#north-america-chart").get(0).getContext("2d");
                var northAmericaChart = new Chart(northAmericaChartCanvas, {
                    type: 'doughnut',
                    data: areaData,
                    options: areaOptions,
                    plugins: northAmericaChartPlugins
                });
                document.getElementById('north-america-legend').innerHTML = northAmericaChart.generateLegend();
            }

            if ($("#order-chart-dark").length) {
                var areaData = {
                    labels: ["10", "", "", "20", "", "", "30", "", "", "40", "", "", "50", "", "", "60", "", "", "70"],
                    datasets: [{
                        data: [200, 480, 700, 600, 620, 350, 380, 350, 850, "600", "650", "350", "590", "350", "620", "500", "990", "780", "650"],
                        borderColor: [
                            '#4747A1'
                        ],
                        borderWidth: 2,
                        fill: false,
                        label: "Orders"
                    },
                    {
                        data: [400, 450, 410, 500, 480, 600, 450, 550, 460, "560", "450", "700", "450", "640", "550", "650", "400", "850", "800"],
                        borderColor: [
                            '#F09397'
                        ],
                        borderWidth: 2,
                        fill: false,
                        label: "Downloads"
                    }
                    ]
                };
                var areaOptions = {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        filler: {
                            propagate: false
                        }
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            ticks: {
                                display: true,
                                padding: 10,
                                fontColor: "#fff"
                            },
                            gridLines: {
                                display: false,
                                drawBorder: false,
                                color: 'transparent',
                                zeroLineColor: '#575757'
                            }
                        }],
                        yAxes: [{
                            display: true,
                            ticks: {
                                display: true,
                                autoSkip: false,
                                maxRotation: 0,
                                stepSize: 200,
                                min: 200,
                                max: 1200,
                                padding: 18,
                                fontColor: "#fff"
                            },
                            gridLines: {
                                display: true,
                                color: "#575757",
                                drawBorder: false
                            }
                        }]
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        enabled: true
                    },
                    elements: {
                        line: {
                            tension: .35
                        },
                        point: {
                            radius: 0
                        }
                    }
                }
                var revenueChartCanvas = $("#order-chart-dark").get(0).getContext("2d");
                var revenueChart = new Chart(revenueChartCanvas, {
                    type: 'line',
                    data: areaData,
                    options: areaOptions
                });
                document.getElementById('order-legend').innerHTML = revenueChart.generateLegend();

            }

            if ($("#sales-chart-dark").length) {
                var SalesChartCanvas = $("#sales-chart-dark").get(0).getContext("2d");
                var SalesChart = new Chart(SalesChartCanvas, {
                    type: 'bar',
                    data: {
                        labels: ["Jan", "Feb", "Mar", "Apr", "May"],
                        datasets: [{
                            label: 'Offline Sales',
                            data: [480, 230, 470, 210, 330],
                            backgroundColor: '#98BDFF'
                        },
                        {
                            label: 'Online Sales',
                            data: [400, 340, 550, 480, 170],
                            backgroundColor: '#4B49AC'
                        }
                        ]
                    },
                    options: {
                        cornerRadius: 5,
                        responsive: true,
                        maintainAspectRatio: true,
                        layout: {
                            padding: {
                                left: 0,
                                right: 0,
                                top: 20,
                                bottom: 0
                            }
                        },
                        scales: {
                            yAxes: [{
                                display: true,
                                gridLines: {
                                    display: true,
                                    drawBorder: false,
                                    color: "#575757"
                                },
                                ticks: {
                                    display: true,
                                    min: 0,
                                    max: 500,
                                    callback: function (value, index, values) {
                                        return value + '$';
                                    },
                                    autoSkip: true,
                                    maxTicksLimit: 10,
                                    fontColor: "#F0F0F0"
                                }
                            }],
                            xAxes: [{
                                stacked: false,
                                ticks: {
                                    beginAtZero: true,
                                    fontColor: "#F0F0F0"
                                },
                                gridLines: {
                                    color: "#575757",
                                    display: false
                                },
                                barPercentage: 1
                            }]
                        },
                        legend: {
                            display: false
                        },
                        elements: {
                            point: {
                                radius: 0
                            }
                        }
                    },
                });
                document.getElementById('sales-legend').innerHTML = SalesChart.generateLegend();
            }

            if ($("#south-america-chart").length) {
                var areaData = {
                    labels: ["Jan", "Feb", "Mar"],
                    datasets: [{
                        data: [60, 70, 70],
                        backgroundColor: [
                            "#4B49AC", "#FFC100", "#248AFD",
                        ],
                        borderColor: "rgba(0,0,0,0)"
                    }]
                };
                var areaOptions = {
                    responsive: true,
                    maintainAspectRatio: true,
                    segmentShowStroke: false,
                    cutoutPercentage: 78,
                    elements: {
                        arc: {
                            borderWidth: 4
                        }
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        enabled: true
                    },
                    legendCallback: function (chart) {
                        var text = [];
                        text.push('<div class="report-chart">');
                        text.push('<div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center"><div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: ' + chart.data.datasets[0].backgroundColor[0] + '"></div><p class="mb-0">Offline sales</p></div>');
                        text.push('<p class="mb-0">495343</p>');
                        text.push('</div>');
                        text.push('<div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center"><div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: ' + chart.data.datasets[0].backgroundColor[1] + '"></div><p class="mb-0">Online sales</p></div>');
                        text.push('<p class="mb-0">630983</p>');
                        text.push('</div>');
                        text.push('<div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center"><div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: ' + chart.data.datasets[0].backgroundColor[2] + '"></div><p class="mb-0">Returns</p></div>');
                        text.push('<p class="mb-0">290831</p>');
                        text.push('</div>');
                        text.push('</div>');
                        return text.join("");
                    },
                }
                var southAmericaChartPlugins = {
                    beforeDraw: function (chart) {
                        var width = chart.chart.width,
                            height = chart.chart.height,
                            ctx = chart.chart.ctx;

                        ctx.restore();
                        var fontSize = 3.125;
                        ctx.font = "600 " + fontSize + "em sans-serif";
                        ctx.textBaseline = "middle";
                        ctx.fillStyle = "#000";

                        var text = "76",
                            textX = Math.round((width - ctx.measureText(text).width) / 2),
                            textY = height / 2;

                        ctx.fillText(text, textX, textY);
                        ctx.save();
                    }
                }
                var southAmericaChartCanvas = $("#south-america-chart").get(0).getContext("2d");
                var southAmericaChart = new Chart(southAmericaChartCanvas, {
                    type: 'doughnut',
                    data: areaData,
                    options: areaOptions,
                    plugins: southAmericaChartPlugins
                });
                document.getElementById('south-america-legend').innerHTML = southAmericaChart.generateLegend();
            }
            if ($("#south-america-chart-dark").length) {
                var areaData = {
                    labels: ["Jan", "Feb", "Mar"],
                    datasets: [{
                        data: [60, 70, 70],
                        backgroundColor: [
                            "#4B49AC", "#FFC100", "#248AFD",
                        ],
                        borderColor: "rgba(0,0,0,0)"
                    }]
                };
                var areaOptions = {
                    responsive: true,
                    maintainAspectRatio: true,
                    segmentShowStroke: false,
                    cutoutPercentage: 78,
                    elements: {
                        arc: {
                            borderWidth: 4
                        }
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        enabled: true
                    },
                    legendCallback: function (chart) {
                        var text = [];
                        text.push('<div class="report-chart">');
                        text.push('<div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center"><div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: ' + chart.data.datasets[0].backgroundColor[0] + '"></div><p class="mb-0">Offline sales</p></div>');
                        text.push('<p class="mb-0">495343</p>');
                        text.push('</div>');
                        text.push('<div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center"><div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: ' + chart.data.datasets[0].backgroundColor[1] + '"></div><p class="mb-0">Online sales</p></div>');
                        text.push('<p class="mb-0">630983</p>');
                        text.push('</div>');
                        text.push('<div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center"><div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: ' + chart.data.datasets[0].backgroundColor[2] + '"></div><p class="mb-0">Returns</p></div>');
                        text.push('<p class="mb-0">290831</p>');
                        text.push('</div>');
                        text.push('</div>');
                        return text.join("");
                    },
                }
                var southAmericaChartPlugins = {
                    beforeDraw: function (chart) {
                        var width = chart.chart.width,
                            height = chart.chart.height,
                            ctx = chart.chart.ctx;

                        ctx.restore();
                        var fontSize = 3.125;
                        ctx.font = "600 " + fontSize + "em sans-serif";
                        ctx.textBaseline = "middle";
                        ctx.fillStyle = "#fff";

                        var text = "76",
                            textX = Math.round((width - ctx.measureText(text).width) / 2),
                            textY = height / 2;

                        ctx.fillText(text, textX, textY);
                        ctx.save();
                    }
                }
                var southAmericaChartCanvas = $("#south-america-chart-dark").get(0).getContext("2d");
                var southAmericaChart = new Chart(southAmericaChartCanvas, {
                    type: 'doughnut',
                    data: areaData,
                    options: areaOptions,
                    plugins: southAmericaChartPlugins
                });
                document.getElementById('south-america-legend').innerHTML = southAmericaChart.generateLegend();
            }

        },
        renderChart() {
            if (document.getElementById('order-chart')) {
                const areaData = {
                    labels: ['10', '', '', '20', '', '', '30', '', '', '40', '', '', '50', '', '', '60', '', '', '70'],
                    datasets: [
                        {
                            data: [
                                200, 480, 700, 600, 620, 350, 380, 350, 850, '1000', '650', '350', '590', '350', '620', '500', '990', '780', '650',
                            ],
                            borderColor: ['#4747A1'],
                            borderWidth: 2,
                            fill: false,
                            label: 'Orders',
                        },
                        {
                            data: [
                                400, 450, 410, 500, 480, 600, 450, 550, 460, '125000', '450', '700', '450', '640', '550', '650', '400', '850', '800',
                            ],
                            borderColor: ['#F09397'],
                            borderWidth: 2,
                            fill: false,
                            label: 'Downloads',
                        },
                    ],
                };

                const areaOptions = {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        filler: {
                            propagate: false,
                        },
                    },
                    scales: {
                        xAxes: [
                            {
                                display: true,
                                ticks: {
                                    display: true,
                                    padding: 10,
                                    fontColor: '#6C7383',
                                },
                                gridLines: {
                                    display: false,
                                    drawBorder: false,
                                    color: 'transparent',
                                    zeroLineColor: '#eeeeee',
                                },
                            },
                        ],
                        yAxes: [
                            {
                                display: true,
                                ticks: {
                                    display: true,
                                    autoSkip: false,
                                    maxRotation: 0,
                                    stepSize: 200,
                                    min: 200,
                                    max: 1200,
                                    padding: 18,
                                    fontColor: '#6C7383',
                                },
                                gridLines: {
                                    display: true,
                                    color: '#f2f2f2',
                                    drawBorder: false,
                                },
                            },
                        ],
                    },
                    legend: {
                        display: false,
                    },
                    tooltips: {
                        enabled: true,
                    },
                    elements: {
                        line: {
                            tension: 0.35,
                        },
                        point: {
                            radius: 0,
                        },
                    },
                };

                const revenueChartCanvas = document.getElementById('order-chart').getContext('2d');
                const revenueChart = new Chart(revenueChartCanvas, {
                    type: 'line',
                    data: areaData,
                    options: areaOptions,
                });
            }
        },
        renderSalesChart() {
            if ($("#sales-chart").length) {
                var SalesChartCanvas = $("#sales-chart").get(0).getContext("2d");
                var SalesChart = new Chart(SalesChartCanvas, {
                    type: 'bar',
                    data: {
                        labels: ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "August", "September", "October", "November", "December"],
                        datasets: [{
                            label: 'Offline Sales',
                            data: [480, 230, 470, 210, 330, 565, 565, 89, 562, 633, 142, 565],
                            backgroundColor: '#059886'
                        },
                        {
                            label: 'Online Sales',
                            data: [400, 340, 550, 480, 170, 4564, 566, 4566, 555, 696, 223],
                            backgroundColor: '#18d8c1'
                        }
                        ]
                    },
                    options: {
                        cornerRadius: 5,
                        responsive: true,
                        maintainAspectRatio: true,
                        layout: {
                            padding: {
                                left: 0,
                                right: 0,
                                top: 20,
                                bottom: 0
                            }
                        },
                        scales: {
                            yAxes: [{
                                display: true,
                                gridLines: {
                                    display: true,
                                    drawBorder: false,
                                    color: "#F2F2F2"
                                },
                                ticks: {
                                    display: true,
                                    min: 0,
                                    max: 560,
                                    callback: function (value, index, values) {
                                        return value + '$';
                                    },
                                    autoSkip: true,
                                    maxTicksLimit: 10,
                                    fontColor: "#6C7383"
                                }
                            }],
                            xAxes: [{
                                stacked: false,
                                ticks: {
                                    beginAtZero: true,
                                    fontColor: "#6C7383"
                                },
                                gridLines: {
                                    color: "rgba(0, 0, 0, 0)",
                                    display: false
                                },
                                barPercentage: 1
                            }]
                        },
                        legend: {
                            display: false
                        },
                        elements: {
                            point: {
                                radius: 0
                            }
                        }
                    },
                });
                document.getElementById('sales-legend').innerHTML = SalesChart.generateLegend();
            }
        }
    },
    components: {
        SelectInput
    }
}



</script>