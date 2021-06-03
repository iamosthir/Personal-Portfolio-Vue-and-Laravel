<template>
  <section class="section">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4>MY Pojects</h4>
            <router-link
              :to="{ name: 'admin-make-project' }"
              class="btn btn-sm btn-primary"
              >Create new Project <i class="fas fa-plus"></i
            ></router-link>
          </div>
          <div class="card-body">
            <div class="text-center" v-if="projects.length <= 0">
              <h4><strong>No projects</strong></h4>
            </div>
            <div class="table-responsive" v-else>
              <table class="table table-hover dataTable">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Project Name</th>
                    <th>Category</th>
                    <th>Skills</th>
                    <th>Created At</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(project, i) in projects" :key="i">
                    <td>
                      <img
                        alt="image"
                        :src="'/upload/project/thumbnails/' + project.thumb"
                        width="35"
                      />
                    </td>
                    <td>{{ project.prject_name }}</td>
                    <td>{{ project.ctg.name }}</td>
                    <td>
                      <span
                        v-for="(skill, i) in project.skills"
                        :key="i"
                        class="badge badge-pill badge-primary ml-1"
                        >{{ skill.name }}</span
                      >
                    </td>
                    <td>
                      {{
                        moment(project.created_at).format(
                          "DD MMMM YYYY , h:mm a"
                        )
                      }}
                    </td>
                    <td>
                      <router-link
                        :to="{
                          name: 'admin-edit-project',
                          params: { id: project.id },
                        }"
                        class="btn btn-sm btn-primary"
                        >Edit</router-link
                      >
                      <button
                        class="btn btn-sm btn-danger"
                        @click="deleteProject(project.id, i)"
                      >
                        Delete
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="row justify-content-center">
              <pagination
                :data="paginateData"
                @pagination-change-page="getProjects"
              ></pagination>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      projects: [],
      moment: moment,
      paginateData: {},
    };
  },
  created() {
    this.getProjects();
  },
  methods: {
    getProjects(page = 1) {
      axios
        .get(`/admin/get-projects?page=${page}`)
        .then((resp) => {
          return resp.data;
        })
        .then((data) => {
          this.paginateData = data;
          this.projects = data.data;
        })
        .catch((err) => {
          console.error(err.response.data);
        });
    },
    deleteProject(projectId, index) {
      Swal.fire({
        title: "Are you sure?",
        text: "Once deleted, can't be restored!!",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#73e375",
        confirmButtonText: "Delete",
      }).then((data) => {
        if (data.isConfirmed) {
          axios
            .post("/admin/delete-project", {
              projectId: projectId,
            })
            .then((resp) => {
              return resp.data;
            })
            .then((data) => {
              if (data.status == "OK") {
                this.projects.splice(index, 1);
                Swal.fire({
                  title: "Success",
                  text: data.msg,
                  icon: "success",
                });
              } else {
                Swal.fire({
                  title: "Failed",
                  text: "Server responded with some error",
                  icon: "error",
                });
              }
            })
            .catch((err) => {
              console.error(err.response.data);
            });
        }
      });
    },
  },
};
</script>

<style>
</style>