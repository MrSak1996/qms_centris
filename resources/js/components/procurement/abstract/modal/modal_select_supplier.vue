<template>
    <div v-if="visible" class="modal-background">
        <div class="modal fade show" tabindex="-1" style="display: block;">
            <div class="modal-dialog modal-xl">
                <div class="modal-content" style="margin-top:-70px">
                    <div class="modal-header">
                        <div
                            style="width: 75px; height: 75px; border-radius: 50%; display: flex; align-items: center; justify-content: center; position: absolute; top: -18px; background-color: white; color: #4cae4c; left: 45%;">
                            <img :src="logo" style="width:60px; height:60px;">
                        </div>
                    </div>
                    <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                        <h5 class="card-title"><font-awesome-icon
                                :icon="['fas', 'circle-info']"></font-awesome-icon>&nbsp;Supplier Infomation List</h5>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">

                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>RFQ Number:</label>
                                            <multiselect track-by="label" label="label" placeholder="Select one"
                                                :searchable="false" v-model="rfq" :options="rfq_opt"></multiselect>
                                        </div>
                                        <TextInput label="Abstract #" iconValue="question" v-model="abstract_no"
                                            :value="abstract_no" :readonly="true" />
                                        <TextInput label="Abstract Date" iconValue="calendar" type="datetime-local"
                                            v-model="date_created" />

                                    </div>
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Supplier:</label>
                                            <multiselect track-by="label" label="label" placeholder="Select one"
                                                :searchable="true" v-model="supplier" :options="supplier_opt"
                                                :multiple="false">
                                            </multiselect>
                                        </div>
                                        <TextInput label="Purchase Request #" iconValue="question" :readonly="true"
                                            :value="pr_no" />
                                        <TextInput label="Purchase Request Date" iconValue="calendar" :readonly="true"
                                            :value="pr_date" />

                                    </div>
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <TextInput label="Total ABC" iconValue="peso-sign" :readonly="true"
                                            :value="total_abc" />
                                        <TextInput label="Office" iconValue="building" :readonly="true" :value="pmo" />
                                        <TextInput label="RFQ Date" iconValue="calendar" readonly="true"
                                            :value="rfq_date" />

                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <TextAreaInput label="Particulars" :value="particulars" />
                                    </div>

                                </div>
                                <div class="row">


                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div style="height:350px; overflow:auto;">

                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr role="row">
                                                            <th colspan="3"> {{ supplier ? supplier.label : '' }}</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="(item, index) in appItems" :key="index">
                                                            <td>{{ item.item_title }}</td>
                                                            <td>
                                                                <TextInput v-model="item.quotation"
                                                                    iconValue="peso-sign" />
                                                            </td>
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
                    <div class="modal-footer">
                        <button @click="saveData()" class="btn btn-outline-primary btn-fw btn-icon-text mr-2 mb-3"
                            style="float:right;">Save</button>

                        <button class="btn btn-outline-primary btn-fw btn-icon-text mr-2 mb-3" @click="close()"
                            style="float:right;">Close</button>



                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style></style>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>

<script>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { library } from '@fortawesome/fontawesome-svg-core'; // Import the library object
import { faCircleInfo } from '@fortawesome/free-solid-svg-icons';
import Multiselect from 'vue-multiselect'

import dilg_logo from "../../../../../assets/logo.png";
import { toast } from "vue3-toastify";

export default {
    props: {
        visible: Boolean,
        rfqNo: String, // Define rfqNo as a prop
        // Other props...
    },
    components: {
        Multiselect,
        FontAwesomeIcon,
    },
    data() {
        return {
            logo: dilg_logo,
            control_no: null,
            abstract_no: null,
            pr_no: null,
            pr_id: null,
            particulars: null,
            pr_date: null,
            pmo: null,
            rfq: null,
            rfq_date: null,
            supplier: null,
            app_item: null,
            total_abc: null,
            rfq_opt: [],
            supplier_opt: [],
            appItems: []

        }
    },

    mounted() {
        this.fetch_rfq();
        this.fetch_supplier();
        this.generateAbstractNo();
    },
    watch: {
        rfq: {
            handler(newValue) {
                if (newValue) {
                    this.fetch_app_item_details(newValue); // Fetch app item whenever rfq changes
                    this.fetch_app_item(newValue); // Fetch app item whenever rfq changes
                }
            },
            immediate: true
        }
    },
    methods: {
        close() {
            this.$emit('close');
        },
        async fetch_rfq() {
            try {
                const response = await axios.get('../../api/fetch_rfq');
                // Assuming response.data is an array of objects with 'label' and 'value' properties
                this.rfq_opt = response.data.map(item => ({ label: item.rfq_no, value: item.id }))
            } catch (error) {
                console.error('Error fetching submitted purchase requests:', error);
            }
        },
        async fetch_supplier() {
            try {
                const response = await axios.get('../../api/fetch_supplier');
                // Assuming response.data is an array of objects with 'label' and 'value' properties
                this.supplier_opt = response.data.map(item => ({ label: item.supplier_title, value: item.id }))
            } catch (error) {
                console.error('Error fetching submitted purchase requests:', error);
            }
        },

        fetch_app_item_details(rfqId) {
            const requestData = {
                id: rfqId.value
            };

            axios.post(`../../api/fetch_app_item_details`, requestData)
                .then(response => {

                    response.data.forEach(item => {
                        this.pr_id = item.id;
                        this.pr_no = item.pr_no;
                        this.particulars = item.particulars;
                        this.pr_date = item.pr_date;
                        this.rfq_date = item.rfq_date;
                        this.pmo = item.pmo_title;
                        this.total_abc = item.total_abc;
                    });
                })
                .catch(error => {
                });
        },
        fetch_app_item(rfqId) {
            const requestData = {
                id: rfqId.value
            };

            axios.post(`../../api/fetch_app_item`, requestData)
                .then(response => {
                    this.appItems = response.data; // Update appItems with fetched data
                })
                .catch(error => {
                    console.error('Error fetching app item:', error);
                });
        },
        generateAbstractNo: async function () {
            try {
                const response = await axios.get('../../api/generateAbstractNo');
                const currentDate = new Date();
                const year = currentDate.getFullYear();
                const month = String(currentDate.getMonth() + 1).padStart(2, '0'); // Adding 1 because months are zero-indexed
                const abstractFormat = `${year}`;
                const abstractSequence = String(response.data[0].abstract).padStart(4, '0'); // Pad with leading zeros
                const abstract_no = `${abstractFormat}-${abstractSequence}`;

                this.abstract_no = abstract_no;
            } catch (error) {
                console.error('Error generating abstract number:', error);
            }

        },
        saveAbsract() {
            // Send data to backend
            axios.post(`../../api/post_create_abstract`, {
                abstract_no: this.abstract_no,
                rfq_id: this.rfq.value,
                pr_id: this.pr_id,
                date_created: this.date_created
            })
                .then(response => {
                   
                   
                })
                .catch(error => {
                    // Handle error
                });

        },
        saveData() {
            this.saveAbsract();
            // Prepare data for saving
            const dataToSave = this.appItems.map(item => ({
                supplier_id: this.supplier.value,
                rfq_id: this.rfq.value,
                pr_id: item.id,
                date_created: this.date_created,
                item_id: item.pr_item_id, // Assuming item.id is the ID of the app_item
                quotation: item.quotation,
            }));

            // Send data to backend
            axios.post(`../../api/post_supplier_quote`, dataToSave)
                .then(response => {
                    // Handle success response
                    toast.success('Successfully added!', {
                        autoClose: 100
                    });
                    setTimeout(() => {
                        this.$router.push({
                            name: 'Abstract',
                            query: { id: this.abstract_no },
                        });

                    }, 1000);
                })
                .catch(error => {
                    // Handle error
                });

        },

    },


};
</script>


<style>
/* Style for dimming the background */
.modal-background {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    /* Adjust the opacity to make it darker or lighter */
    z-index: 1050;
    /* Ensure it's above other elements */
}

/* Style for centering the modal */
.modal-dialog {
    margin-top: 10%;
    /* Adjust as needed */
}

.selected img {
    border: 2px solid #007bff;
    /* Change the border color as needed */
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    /* Change the box shadow as needed */
}

/* Style for dimming the background */
.modal-background {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    /* Adjust the opacity to make it darker or lighter */
    z-index: 1050;
    /* Ensure it's above other elements */
}

/* Style for centering the modal */
.modal-dialog {
    margin-top: 10%;
    /* Adjust as needed */
}

/* You may need additional styles to customize the appearance of the modal */
</style>