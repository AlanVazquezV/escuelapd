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
                                    Agregar nueva clase
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
                                <form ref="observer" tag="form" @submit.prevent="submitForm()" :class="{ 'card ': !isSubPage }" class=" ">
                                    <div class="grid">
                                        <div class="col-12">
                                            <div class="formgrid grid">
                                                <div class="col-12 md:col-3">
                                                    Nombre 
                                                </div>
                                                <div class="col-12 md:col-9">
                                                    <InputText  ref="ctrlname" v-model.trim="formData.name"  label="Nombre" type="text" placeholder="Ingresar nombre"      
                                                    class=" w-full" :class="getErrorClass('name')">
                                                    </InputText>
                                                    <small v-if="isFieldValid('name')" class="p-error">{{ getFieldError('name') }}</small> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="formgrid grid">
                                                <div class="col-12 md:col-3">
                                                    Descripcion 
                                                </div>
                                                <div class="col-12 md:col-9">
                                                    <InputText  ref="ctrldescription" v-model.trim="formData.description"  label="Descripcion" type="text" placeholder="Ingresar descripcion"      
                                                    class=" w-full" :class="getErrorClass('description')">
                                                    </InputText>
                                                    <small v-if="isFieldValid('description')" class="p-error">{{ getFieldError('description') }}</small> 
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
                                                            <Dropdown  class="w-full" :class="getErrorClass('cycle')"   :loading="req.loading"   optionLabel="label" optionValue="value" ref="ctrlcycle"  v-model="formData.cycle" :options="req.response" label="Ciclo"  placeholder="Seleccione ciclo..." >
                                                            </Dropdown> 
                                                            <small v-if="isFieldValid('cycle')" class="p-error">{{ getFieldError('cycle') }}</small> 
                                                        </template>
                                                    </api-data-source>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="formgrid grid">
                                                <div class="col-12 md:col-3">
                                                    Modalidad 
                                                </div>
                                                <div class="col-12 md:col-9">
                                                    <api-data-source   api-path="components_data/modality_option_list" >
                                                        <template v-slot="req">
                                                            <Dropdown  class="w-full" :class="getErrorClass('modality')"   :loading="req.loading"   optionLabel="label" optionValue="value" ref="ctrlmodality"  v-model="formData.modality" :options="req.response" label="Modalidad"  placeholder="Seleccione modalidad" >
                                                            </Dropdown> 
                                                            <small v-if="isFieldValid('modality')" class="p-error">{{ getFieldError('modality') }}</small> 
                                                        </template>
                                                    </api-data-source>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="formgrid grid">
                                                <div class="col-12 md:col-3">
                                                    Hora 
                                                </div>
                                                <div class="col-12 md:col-9">
                                                    <Calendar  :showButtonBar="true" class="w-full" :class="getErrorClass('time')" v-model="formData.time"     :showTime="true" :timeOnly="true"      />
                                                    <small v-if="isFieldValid('time')" class="p-error">{{ getFieldError('time') }}</small> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="formgrid grid">
                                                <div class="col-12 md:col-3">
                                                    Mestro 
                                                </div>
                                                <div class="col-12 md:col-9">
                                                    <api-data-source   api-path="components_data/user_option_list" >
                                                        <template v-slot="req">
                                                            <Dropdown  class="w-full" :class="getErrorClass('user')"   :loading="req.loading"   optionLabel="label" optionValue="value" ref="ctrluser"  v-model="formData.user" :options="req.response" label="Mestro"  placeholder="Seleccione maestro" >
                                                            </Dropdown> 
                                                            <small v-if="isFieldValid('user')" class="p-error">{{ getFieldError('user') }}</small> 
                                                        </template>
                                                    </api-data-source>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="formgrid grid">
                                                <div class="col-12 md:col-3">
                                                    Lugar 
                                                </div>
                                                <div class="col-12 md:col-9">
                                                    <InputText  ref="ctrlplace" v-model.trim="formData.place"  label="Lugar" type="text" placeholder="Ingresar salon o url"      
                                                    class=" w-full" :class="getErrorClass('place')">
                                                    </InputText>
                                                    <small v-if="isFieldValid('place')" class="p-error">{{ getFieldError('place') }}</small> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="formgrid grid">
                                                <div class="col-12 md:col-3">
                                                    Banner 
                                                </div>
                                                <div class="col-12 md:col-9">
                                                    <div class="mb-3">
                                                        <Uploader :class="getErrorClass('banner')" upload-path="fileuploader/upload/banner" v-model="formData.banner" :fileLimit="1" :maxFileSize="3000000" accept=".jpg,.png,.gif,.jpeg" :multiple="false" label="Choose files or drop files here" />
                                                    </div>
                                                    <small v-if="isFieldValid('banner')" class="p-error">{{ getFieldError('banner') }}</small> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-if="showSubmitButton" class="text-center my-3">
                                        <Button class="p-button-primary" type="submit" label="Agregar" icon="pi pi-send" :loading="saving" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </template>
    </main>
</template>
<script setup>
	import {  computed,  reactive, toRefs, onMounted } from 'vue';
	import { required, numeric, } from 'src/services/validators';
	import { useApp } from 'src/composables/app.js';
	import { useAddPage } from 'src/composables/addpage.js';
	import { usePageStore } from 'src/store/page';
	const props = defineProps({
		pageStoreKey: {
			type: String,
			default: 'CLASSES',
		},
		pageName : {
			type : String,
			default : 'classes',
		},
		routeName : {
			type : String,
			default : 'classesadd',
		},
		apiPath : {
			type : String,
			default : 'classes/add',
		},
		submitButtonLabel: {
			type: String,
			default: "Agregar",
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
			default: "Create Record",
		},
		msgAfterSave: {
			type: String,
			default: "Se agrego correctamente",
		},
		msgBeforeSave: {
			type: String,
			default: "",
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
		pageData: { // use to set formData default values from another page
			type: Object,
			default: () => {} 
		},
	});
	//lines
	const store = usePageStore(props.pageStoreKey);
	const app = useApp();
	
	const formDefaultValues = {
		name: "", 
		description: "", 
		cycle: "", 
		modality: "", 
		time: "NULL", 
		user: "", 
		place: "NULL", 
		banner: "", 
	};
	
	const formData = reactive({ ...formDefaultValues });
	
	//vuelidate form validation rules
	const rules = computed(() => {
		return {
			name: {  },
			description: {  },
			cycle: { numeric },
			modality: { numeric },
			time: {  },
			user: { numeric },
			place: {  },
			banner: {  }
		}
	});
	
	const page = useAddPage({ store, props, formData, rules, beforeSubmit, afterSubmit });
	
	// event raised before submit form
	function beforeSubmit(){
		return true;
	}
	
	// event raised after form submited
	function afterSubmit(response) { 
		app.flashMsg(props.msgTitle, props.msgAfterSave);
		page.setFormDefaultValues(); //reset form data
		if(app.isDialogOpen()){
			app.closeDialogs(); // if page is open as dialog, close dialog
		}
		else if(props.redirect) {
			app.navigateTo(`/classes/list_usuario`);
		}
	}
	
	const {  saving, pageReady, } = toRefs(page.state);
	
	const { submitForm, getErrorClass, getFieldError, isFieldValid,  } = page.methods;
	
	onMounted(()=>{
		const pageTitle = "Agregar nueva clase";
		app.setPageTitle(props.routeName, pageTitle); // set browser page title
	});
	
	// expose page object for other components access
	defineExpose({
		page
	});
</script>
<style scoped>
</style>
