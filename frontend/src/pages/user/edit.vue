<template>
    <main class="main-page"  id="">
        <template v-if="pageReady">
            <template v-if="showHeader">
                <section class="page-section mb-3" >
                    <div class="container">
                        <div class="grid align-items-center">
                            <div  v-if="!isSubPage"  class="col-fixed " >
                                <Button @click="$router.go(-1)" label=""  class="p-button p-button-text " icon="pi pi-arrow-left"  />
                            </div>
                            <div  class="col " >
                                <div class=" text-2xl text-primary font-bold" >
                                    Editar usuario
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </template>
            <section class="page-section " >
                <div class="container">
                    <div class="grid ">
                        <div  class="md:col-9 sm:col-12 comp-grid" >
                            <div >
                                <form ref="observer"  tag="form" @submit.prevent="submitForm()" :class="{ 'card ': !isSubPage }" class=" ">
                                    <!--[form-content-start]-->
                                    <div class="grid">
                                        <div class="col-12">
                                            <div class="formgrid grid">
                                                <div class="col-12 md:col-3">
                                                    Nombre *
                                                </div>
                                                <div class="col-12 md:col-9">
                                                    <check-duplicate v-model="formData.name" check-path="components_data/user_name_exist/" v-slot="checker">
                                                    <InputText  ref="ctrlname" @blur="checker.check" :loading="checker.loading" v-model.trim="formData.name"  label="Nombre" type="text" placeholder="Insertar nombre"      
                                                    class=" w-full" :class="getErrorClass('name')">
                                                    </InputText>
                                                    <small v-if="isFieldValid('name')" class="p-error">{{ getFieldError('name') }}</small> 
                                                    <small v-if="!checker.loading && checker.exist" class="p-error"> Not available</small>
                                                    <small v-if="checker.loading" class="text-500">Checking...</small>
                                                    </check-duplicate>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="formgrid grid">
                                                <div class="col-12 md:col-3">
                                                    Apellido 
                                                </div>
                                                <div class="col-12 md:col-9">
                                                    <InputText  ref="ctrllastname" v-model.trim="formData.lastname"  label="Apellido" type="text" placeholder="Insertar apellido"      
                                                    class=" w-full" :class="getErrorClass('lastname')">
                                                    </InputText>
                                                    <small v-if="isFieldValid('lastname')" class="p-error">{{ getFieldError('lastname') }}</small> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="formgrid grid">
                                                <div class="col-12 md:col-3">
                                                    Tipo 
                                                </div>
                                                <div class="col-12 md:col-9">
                                                    <api-data-source   api-path="components_data/type_option_list" >
                                                        <template v-slot="req">
                                                            <Dropdown  class="w-full" :class="getErrorClass('type')"   :loading="req.loading"   optionLabel="label" optionValue="value" ref="ctrltype"  v-model="formData.type" :options="req.response" label="Tipo"  placeholder="Selecciona el tipo.." >
                                                            </Dropdown> 
                                                            <small v-if="isFieldValid('type')" class="p-error">{{ getFieldError('type') }}</small> 
                                                        </template>
                                                    </api-data-source>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="formgrid grid">
                                                <div class="col-12 md:col-3">
                                                    Usuario *
                                                </div>
                                                <div class="col-12 md:col-9">
                                                    <check-duplicate v-model="formData.username" check-path="components_data/user_username_exist/" v-slot="checker">
                                                    <InputText  ref="ctrlusername" @blur="checker.check" :loading="checker.loading" v-model.trim="formData.username"  label="Usuario" type="text" placeholder="Ingrese el usuario"      
                                                    class=" w-full" :class="getErrorClass('username')">
                                                    </InputText>
                                                    <small v-if="isFieldValid('username')" class="p-error">{{ getFieldError('username') }}</small> 
                                                    <small v-if="!checker.loading && checker.exist" class="p-error"> Not available</small>
                                                    <small v-if="checker.loading" class="text-500">Checking...</small>
                                                    </check-duplicate>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="formgrid grid">
                                                <div class="col-12 md:col-3">
                                                    Estatus 
                                                </div>
                                                <div class="col-12 md:col-9">
                                                    <api-data-source   api-path="components_data/status_option_list_2" >
                                                        <template v-slot="req">
                                                            <Dropdown  class="w-full" :class="getErrorClass('status')"   :loading="req.loading"   optionLabel="label" optionValue="value" ref="ctrlstatus"  v-model="formData.status" :options="req.response" label="Estatus"  placeholder="Selecciona un estatus" >
                                                            </Dropdown> 
                                                            <small v-if="isFieldValid('status')" class="p-error">{{ getFieldError('status') }}</small> 
                                                        </template>
                                                    </api-data-source>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="formgrid grid">
                                                <div class="col-12 md:col-3">
                                                    Horario 
                                                </div>
                                                <div class="col-12 md:col-9">
                                                    <api-data-source   api-path="components_data/name_option_list" >
                                                        <template v-slot="req">
                                                            <Dropdown  class="w-full" :class="getErrorClass('schedule')"   :loading="req.loading"   optionLabel="label" optionValue="value" ref="ctrlschedule"  v-model="formData.schedule" :options="req.response" label="Horario"  placeholder="Seleccione horario..." >
                                                            </Dropdown> 
                                                            <small v-if="isFieldValid('schedule')" class="p-error">{{ getFieldError('schedule') }}</small> 
                                                        </template>
                                                    </api-data-source>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="formgrid grid">
                                                <div class="col-12 md:col-3">
                                                    Celular 
                                                </div>
                                                <div class="col-12 md:col-9">
                                                    <InputText  ref="ctrlmobile" v-model.trim="formData.mobile"  label="Celular" type="text" placeholder="Ingrese un celular"      
                                                    class=" w-full" :class="getErrorClass('mobile')">
                                                    </InputText>
                                                    <small v-if="isFieldValid('mobile')" class="p-error">{{ getFieldError('mobile') }}</small> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="formgrid grid">
                                                <div class="col-12 md:col-3">
                                                    Imagen 
                                                </div>
                                                <div class="col-12 md:col-9">
                                                    <div class="mb-3">
                                                        <Uploader :class="getErrorClass('image')" :auto="true" :fileLimit="1" :maxFileSize="3000000" accept=".jpg,.png,.gif,.jpeg" :multiple="false" style="width:100%" label="Choose files or drop files here" upload-path="fileuploader/upload/image" v-model="formData.image"></Uploader>
                                                    </div>
                                                    <small v-if="isFieldValid('image')" class="p-error">{{ getFieldError('image') }}</small> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="formgrid grid">
                                                <div class="col-12 md:col-3">
                                                    Ciclo 
                                                </div>
                                                <div class="col-12 md:col-9">
                                                    <api-data-source   api-path="components_data/cycle_option_list" >
                                                        <template v-slot="req">
                                                            <Dropdown  class="w-full" :class="getErrorClass('cycle')"   :loading="req.loading"   optionLabel="label" optionValue="value" ref="ctrlcycle"  v-model="formData.cycle" :options="req.response" label="Ciclo"  placeholder="Seleccione un ciclo.." >
                                                            </Dropdown> 
                                                            <small v-if="isFieldValid('cycle')" class="p-error">{{ getFieldError('cycle') }}</small> 
                                                        </template>
                                                    </api-data-source>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--[form-content-end]-->
                                    <div v-if="showSubmitButton" class="text-center my-3">
                                        <Button type="submit" label="Editar" icon="pi pi-send" :loading="saving" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </template>
        <template v-if="loading">
            <div style="min-height:200px" class="flex gap-3 justify-content-center align-items-center p-3">
                <div><ProgressSpinner style="width:50px;height:50px" /> </div>
                <div class="text-500">Loading... </div>
            </div>
        </template>
    </main>
</template>
<script setup>
	import {  computed,  reactive, toRefs, onMounted } from 'vue';
	import { required, numeric, } from 'src/services/validators';
	import { useApp } from 'src/composables/app.js';
	import { useEditPage } from 'src/composables/editpage.js';
	import { usePageStore } from 'src/store/page';
	const props = defineProps({
		id: [String, Number],
		pageStoreKey: {
			type: String,
			default: 'USER',
		},
		pageName: {
			type: String,
			default: 'user',
		},
		routeName: {
			type: String,
			default: 'useredit',
		},
		pagePath: {
			type : String,
			default : 'user/edit',
		},
		apiPath: {
			type: String,
			default: 'user/edit',
		},
		submitButtonLabel: {
			type: String,
			default: "Editar",
		},
		formValidationError: {
			type: String,
			default: "Form is invalid",
		},
		formValidationMsg: {
			type: String,
			default: "Please complete the form",
		},
		msgTitle: {
			type: String,
			default: "Update Record",
		},
		msgBeforeSave: {
			type: String,
			default: "",
		},
		msgAfterSave: {
			type: String,
			default: "Se ha editado correctamente",
		},
		showHeader: {
			type: Boolean,
			default: true,
		},
		showSubmitButton: {
			type: Boolean,
			default: true,
		},
		redirect: {
			type : Boolean,
			default : true,
		},
		isSubPage: {
			type : Boolean,
			default : false,
		},
	});
	
	const store = usePageStore(props.pageStoreKey);
	const app = useApp();
	
	const formDefaultValues = Object.assign({
		name: "", 
		lastname: "", 
		type: "", 
		username: "", 
		status: "", 
		schedule: "", 
		mobile: "NULL", 
		image: "", 
		cycle: "", 
	}, props.pageData);
	
	const formData = reactive({ ...formDefaultValues });
	
	function afterSubmit(response) {
		app.flashMsg(props.msgTitle, props.msgAfterSave);
		if(app.isDialogOpen()){
			app.closeDialogs(); // if page is open as dialog, close dialog
		}
		else if(props.redirect) {
			app.navigateTo(`/user`);
		}
	}
	
	// form validation rules
	const rules = computed(() => {
		return {
			name: { required },
			lastname: {  },
			type: { numeric },
			username: { required },
			status: { numeric },
			schedule: { numeric },
			mobile: {  },
			image: {  },
			cycle: { numeric }
		}
	});
	
	const page = useEditPage({store, props, formData, rules, afterSubmit });
	
	const {  currentRecord: editRecord } = toRefs(store.state);
	const {  pageReady, saving, loading, } = toRefs(page.state);
	
	const { apiUrl } = page.computedProps;
	
	const { load, submitForm, getErrorClass, getFieldError, isFieldValid,  } = page.methods;
	
	onMounted(()=>{
		const pageTitle = "Editar usuario";
		app.setPageTitle(props.routeName, pageTitle); // set browser page title
	});
</script>
<style scoped>
</style>
