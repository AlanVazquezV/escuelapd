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
                                    Editar clase
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
                                                        <Uploader :class="getErrorClass('banner')" :auto="true" :fileLimit="1" :maxFileSize="3000000" accept=".jpg,.png,.gif,.jpeg" :multiple="false" style="width:100%" label="Choose files or drop files here" upload-path="fileuploader/upload/banner" v-model="formData.banner"></Uploader>
                                                    </div>
                                                    <small v-if="isFieldValid('banner')" class="p-error">{{ getFieldError('banner') }}</small> 
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
			default: 'CLASSES',
		},
		pageName: {
			type: String,
			default: 'classes',
		},
		routeName: {
			type: String,
			default: 'classesedit',
		},
		pagePath: {
			type : String,
			default : 'classes/edit',
		},
		apiPath: {
			type: String,
			default: 'classes/edit',
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
			default: "Se ha editado",
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
		description: "", 
		cycle: "", 
		modality: "", 
		time: "NULL", 
		user: "", 
		place: "NULL", 
		banner: "", 
	}, props.pageData);
	
	const formData = reactive({ ...formDefaultValues });
	
	function afterSubmit(response) {
		app.flashMsg(props.msgTitle, props.msgAfterSave);
		if(app.isDialogOpen()){
			app.closeDialogs(); // if page is open as dialog, close dialog
		}
		else if(props.redirect) {
			app.navigateTo(`/classes/list_usuario`);
		}
	}
	
	// form validation rules
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
	
	const page = useEditPage({store, props, formData, rules, afterSubmit });
	
	const {  currentRecord: editRecord } = toRefs(store.state);
	const {  pageReady, saving, loading, } = toRefs(page.state);
	
	const { apiUrl } = page.computedProps;
	
	const { load, submitForm, getErrorClass, getFieldError, isFieldValid,  } = page.methods;
	
	onMounted(()=>{
		const pageTitle = "Editar clase";
		app.setPageTitle(props.routeName, pageTitle); // set browser page title
	});
</script>
<style scoped>
</style>
