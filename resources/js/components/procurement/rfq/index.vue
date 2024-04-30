<style>
th, td {
    padding: 8px; /* Optional: Add padding for better spacing */
    white-space: nowrap; /* Prevent text from wrapping */
    overflow: hidden; /* Hide overflow content */
    text-overflow: ellipsis; /* Display ellipsis (...) for overflowed text */
    max-width: 300px; /* Maximum width of cells */
  }
  
.profile_img {
    width: 100px;
    height: 100px;
    padding: 1px;
    margin-bottom: 15%;
    border-radius: 100%;
    border: 1px solid rgb(18, 15, 76);
}

.user_info {
    display: flex;
    justify-content: space-between;
    margin: 0px;
    vertical-align: middle;
    width: 100%;
}

.rank_banner {
    background-color: rgb(104, 34, 142);
    color: rgb(255, 255, 255);
    font-family: Barlow, sans-serif;
    font-size: 1.25rem;
    font-weight: 400;
    line-height: 1.5;
    margin: 0px;
    text-decoration: none;
}

.rank_banner2 {
    background-color: rgb(128, 22, 22);
    color: rgb(255, 255, 255);
    font-family: Barlow, sans-serif;
    font-size: 1.25rem;
    font-weight: 400;
    line-height: 1.5;
    margin: 0px;
    text-decoration: none;
}

.rank_banner3 {
    background-color: rgb(45, 2, 85);
    color: rgb(255, 255, 255);
    font-family: Barlow, sans-serif;
    font-size: 1.25rem;
    font-weight: 400;
    line-height: 1.5;
    margin: 0px;
    text-decoration: none;
}

.rank_wrapper {
    -webkit-clip-path: polygon(100% 0px, 0px 0px, 100% 100%);
    clip-path: polygon(100% 0px, 0px 0px, 100% 100%);
    height: 4.5rem;
    padding-right: 4px;
    padding-top: 2px;
    position: absolute;
    right: 0px;
    text-align: right;
    top: 0px;
    width: 4.5rem;
}

.card_shadow {
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    /* Change box shadow on hover for an interactive effect */

}
</style>
<template>
    <div class="container-scroller">
        <Navbar></Navbar>
        <div class="container-fluid page-body-wrapper">
            <Sidebar />
            <div class="main-panel">
                <div class="content-wrapper">
                    <BreadCrumbs />
                    <div class="row">
                        <StatBox/>
                        <div class="col-lg-12 col-md-12 col-sm-12">                            
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex justify-content-between align-items-center">
                                        <h5 class="card-title">
                                            <font-awesome-icon
                                                :icon="['fas', 'list']"></font-awesome-icon>&nbsp;Create RFQ
                                        </h5>
                                        <div class="d-flex">
                                            <button class="btn btn-outline-primary btn-fw btn-icon-text mx-2" @click="openModal()">
                                              Create RFQ
                                            </button>
                                            <button class="btn btn-outline-primary btn-fw btn-icon-text mx-2" >
                                                Advanced Search
                                            </button>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">

                                            <thead>
                                                <tr>
                                                    <th>Actions</th>
                                                    <th>Purchase Request No.</th>
                                                    <th>Request for Quotation No.</th>
                                                    <th>Total Amount</th>
                                                    <th style="width: 10px !important;">Particulars</th>
                                                    <th>Purchase Date</th>
                                                    <th>Target Date</th>
                                                    <th>Status</th>
                                                    <th>Time Elapsed</th>
                                                    <th>Created By</th>
                                                   
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr v-for="purchaseRequest in displayedItems" :key="purchaseRequest.id">
                                                    <td>
                                                        <div v-if="this.userId == 1" class="template-demo d-flex justify-content-between flex-nowrap">
                                                            
                                                        <button class="btn btn-icon mr-1" @click="viewPr(purchaseRequest.id, purchaseRequest.status_id, purchaseRequest.step)" style="background-color:#059886;color:#fff;">
                                                            <font-awesome-icon :icon="['fas', 'eye']"></font-awesome-icon> </button>
                                                        <button class="btn btn-icon mr-1" @click="toGSS(purchaseRequest.id)" style="background-color:#059886;color:#fff;"> 
                                                            <font-awesome-icon :icon="['fas', 'circle-check']"></font-awesome-icon> 
                                                        </button>



                                                            <button type="button" class="btn btn-icon mr-1" style="background-color:#059886;color:#fff;">
                                                                <i class="ti-trash" style="margin-left: -3px;"></i>
                                                            </button>
                                                            <button class="btn btn-icon mr-1" style="background-color:#059886;color:#fff;" @click="exportRFQ(purchaseRequest.rfq_no)">
                                                                <i class="ti-download"
                                                                    
                                                                    style="margin-left: -3px;"></i>
                                                            </button>
                                                        </div>

                                                        <div v-else-if="purchaseRequest.user_id == this.userId"
                                                            class="template-demo d-flex justify-content-between flex-nowrap">
                                                                
                                                            <button class="btn btn-icon mr-1" @click="viewPr(purchaseRequest.id, purchaseRequest.status_id, purchaseRequest.step)"
                                                            style="background-color:#059886;color:#fff;">
                                                            <font-awesome-icon
                                                                :icon="['fas', 'eye']"></font-awesome-icon>
                                                        </button>
                                                            <button type="button"
                                                                class="btn btn-danger btn-rounded btn-icon">
                                                                <i class="ti-trash" style="margin-left: -3px;"></i>

                                                            </button>
                                                            <button class="btn btn-warning btn-rounded btn-icon"  @click="exportRFQ(purchaseRequest.rfq_no)">
                                                                <i class="ti-download"
                                                                   
                                                                    style="margin-left: -3px;"></i>
                                                            </button>
                                                        </div>
                                                        <div v-else
                                                            class="template-demo d-flex justify-content-between flex-nowrap">
                                                                  
                                                            <button class="btn btn-icon mr-1" @click="viewPr(purchaseRequest.id, purchaseRequest.status_id, purchaseRequest.step)"
                                                            style="background-color:#059886;color:#fff;">
                                                            <font-awesome-icon
                                                                :icon="['fas', 'eye']"></font-awesome-icon>
                                                        </button>
                                                        <button class="btn btn-icon mr-1"
                                                        @click="toGSS(purchaseRequest.id)"
                                                        style="background-color:#059886;color:#fff;">
                                                        <font-awesome-icon
                                                            :icon="['fas', 'circle-check']"></font-awesome-icon>

                                                    </button>

                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="badge badge-default"
                                                            @click="$router.push({ path: `/procurement/view_pr/${purchaseRequest.id}` })">
                                                            <b>{{ purchaseRequest.pr_no }}</b><br><i>~{{
                                                                purchaseRequest.office
                                                            }}~</i>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="badge badge-default">
                                                            <b>{{ purchaseRequest.rfq_no }}</b><br><i>~{{
                                                                purchaseRequest.rfq_date }}~</i>
                                                        </div>

                                                    </td>


                                                    <td>Php. {{ formatAmount(purchaseRequest.app_price) }}</td>
                                                    <td style="width: 10px !important;">{{ purchaseRequest.particulars }}</td>
                                                    <td>{{ purchaseRequest.pr_date }}</td>
                                                    <td>{{ purchaseRequest.target_date }}</td>
                                                    <td>
                                                        <div v-if="purchaseRequest.status_id == 1"
                                                            class="badge badge-success">
                                                            {{
                                                                purchaseRequest.status }}
                                                        </div>
                                                        <div v-if="purchaseRequest.status_id == 2"
                                                            class="badge badge-primary">
                                                            {{
                                                                purchaseRequest.status }}
                                                        </div>
                                                        <div v-if="purchaseRequest.status_id == 3"
                                                            class="badge badge-warning">
                                                            {{
                                                                purchaseRequest.status }}
                                                        </div>
                                                        <div v-if="purchaseRequest.status_id == 4"
                                                            class="badge badge-submitted_gss">{{
                                                                purchaseRequest.status
                                                            }}</div>
                                                        <div v-if="purchaseRequest.status_id == 5"
                                                            class="badge badge-received_gss">{{
                                                                purchaseRequest.status }}
                                                        </div>
                                                        <div v-if="purchaseRequest.status_id == 6"
                                                            class="badge badge-with-rfq">
                                                            {{
                                                                purchaseRequest.status }}
                                                        </div>
                                                        <div v-if="purchaseRequest.status_id == 7"
                                                            class="badge badge-cancelled">{{
                                                                purchaseRequest.status }}
                                                        </div>
                                                    </td>
                                                    <td>5 minutes ago</td>
                                                    <td>{{ purchaseRequest.created_by }}</td>

                                                  

                                                </tr>
                                            </tbody>
                                        </table>
                                        <Pagination :total="purchaseRequests.length" @pageChange="onPageChange" />
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <FooterVue />
            </div>
        </div>
        <ModalRFQ :visible="modalVisible" @close="closeModal" />
    </div>
</template>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>

<script>
import Navbar from '../../layout/Navbar.vue';
import Sidebar from '../../layout/Sidebar.vue';
import FooterVue from '../../layout/Footer.vue';
import BreadCrumbs from '../../dashboard_tiles/BreadCrumbs.vue';
import UserInfo from '../../procurement/user_info.vue';
import Pagination from '../Pagination.vue';
import ModalRFQ from './modal/modal_create_rfq.vue';
import StatBox from '../stat_board.vue';

import axios from 'axios';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { library } from '@fortawesome/fontawesome-svg-core'; // Import the library object
import { faEye, faPaperPlane } from '@fortawesome/free-solid-svg-icons';
import { toast } from "vue3-toastify";
import { formatTotalAmount } from '../../../globalMethods';
library.add(faEye, faPaperPlane);
export default {
    name: 'Request for Quotation',
    props: {

    },
    data() {
        return {
            userId: null,
            selected:null,
            options:[],
            purchaseRequests: [],
            selectedRows: [],
            currentPage: 1,
            itemsPerPage: 5,
            modalVisible: false,

        };
    },
    components: {
        Navbar,
        Sidebar,
        FooterVue,
        BreadCrumbs,
        UserInfo,
        Pagination,
        FontAwesomeIcon,
        ModalRFQ,
        StatBox
    },
    computed: {
        totalPages() {
            return Math.ceil(this.purchaseRequests.length / this.itemsPerPage);
        },
        displayedItems() {
            const start = (this.currentPage - 1) * this.itemsPerPage;
            const end = start + this.itemsPerPage;
            return this.purchaseRequests.slice(start, end);
        },
    },
    mounted() {
        this.loadData();
        this.fetchSubmittedPurchaseRequest();
   this.userId= localStorage.getItem('userId');


    },
    methods: {
        async fetchSubmittedPurchaseRequest() {
      try {
        const response = await axios.get('../../api/fetchSubmittedPurchaseRequest');
        // Assuming response.data is an array of objects with 'label' and 'value' properties
        this.options = response.data.map(item =>  item.pr_no);
      } catch (error) {
        console.error('Error fetching submitted purchase requests:', error);
      }
    },
        openModal() {
            this.modalVisible = true;
        },
        closeModal() {
            this.modalVisible = false;
        },
        formatAmount(price) {
            return formatTotalAmount(price);
        },
        selectAllRows(event) {
            if (event.target.checked) {
                this.selectedRows = this.displayedItems.map(item => item.id);
            } else {
                this.selectedRows = [];
            }
        },
        selectRow(id) {
            if (this.selectedRows.includes(id)) {
                this.selectedRows = this.selectedRows.filter(rowId => rowId !== id);
            } else {
                this.selectedRows.push(id);
            }
            console.log("Selected PurchaseRequest IDs:", this.selectedRows);

        },
        loadData() {
            axios.post(`../../api/fetchSubmittedtoGSS`)
                .then(response => {
                    this.purchaseRequests = response.data.data;
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        },
        onPageChange(page) {
            this.currentPage = page;
            // Fetch data for the new page
            this.loadData();
        },
        viewPr(pr_id,) {
            this.$router.push(`/procurement/rfq/` + pr_id);


        },
        exportRFQ(rfq_id) {
            // console.log(rfq_id);
            window.location.href = `../../api/export-rfq/${rfq_id}?export=true`;
        },
        toGSS(id) {
            const STATUS_RECEIVED_BY_GSS = 5;
            axios.post(`../../api/post_update_status`, {
                pr_id: id,
                status: STATUS_RECEIVED_BY_GSS,
            }
            ).then(() => {
                toast.success('Successfully submitted to the GSS!', {
                    autoClose: 2000
                });
                // location.reload();
            }).catch((error) => {

            })

        }
    },

}
</script>
