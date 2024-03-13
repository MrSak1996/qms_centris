<template>
  <div class="card card_shadow">
    <div class="card-body">
   
      <div class="card">
        <div class="card-body">
          <p class="card-title">Annual Procurement Plan for F.Y 2023</p>
          <div class="box-tools">
            <button @click="toCreatePR()" type="button" class="btn btn-outline-primary btn-fw btn-icon-text">
              Create PR
            </button>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                  <div class="row">
                    <div class="col-sm-12 col-md-6"></div>
                    <div class="col-sm-12 col-md-6"></div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <procurement_table />
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12 col-md-5"></div>
                    <div class="col-sm-12 col-md-7"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import procurement_table from '../../components/procurement/procurement_table.vue';

export default {
  name: 'DetailedReport',
  components: {
    procurement_table
  },
  mounted() {
  },
  methods: {
    toCreatePR() {
            this.$router.push("/procurement/create_pr");
        },
    
  }
}
</script>