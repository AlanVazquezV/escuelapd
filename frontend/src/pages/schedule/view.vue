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
                                    Detalles de horario
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </template>
            <section class="page-section " >
                <div class="container">
                    <div class="grid ">
                        <div  class="col comp-grid" >
                            <div >
                                <div class="mb-3 grid justify-content-start">
                                    <div class="col-12 md:col-4">
                                        <div class="card flex gap-3 align-items-center p-3 ">
                                            <div class="">
                                                <div class="text-400 font-medium mb-1">Nombre de la clase</div>
                                                <div class="font-bold">{{ item.classes_name }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 md:col-4">
                                        <div class="card flex gap-3 align-items-center p-3 ">
                                            <div class="">
                                                <div class="text-400 font-medium mb-1">Descripcion de la clase</div>
                                                <div class="font-bold">{{ item.classes_description }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 md:col-4">
                                        <div class="card flex gap-3 align-items-center p-3 ">
                                            <div class="">
                                                <div class="text-400 font-medium mb-1">Banner</div>
                                                <div class="font-bold">
                                                    <image-viewer image-size="medium" image-preview-size="" :src="item.classes_banner" width="auto" height="auto" class="img-fluid" :num-display="1">
                                                    </image-viewer>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 md:col-4">
                                        <div class="card flex gap-3 align-items-center p-3 ">
                                            <div class="">
                                                <div class="text-400 font-medium mb-1">Hora de la clase</div>
                                                <div class="font-bold">{{ item.classes_time }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 md:col-4">
                                        <div class="card flex gap-3 align-items-center p-3 ">
                                            <div class="">
                                                <div class="text-400 font-medium mb-1">Nombre dle horario</div>
                                                <div class="font-bold">{{ item.schedule_name_label }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex gap-3 justify-content-start">
                                    <Menubar class="p-0 inline-menu" ref="actionMenu" :model="getActionMenuModel(item)" />
                                </div>
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
	import {   toRefs, onMounted } from 'vue';
	import { useApp } from 'src/composables/app.js';
	import { useAuth } from 'src/composables/auth';
	import { usePageStore } from 'src/store/page';
	import { useViewPage } from 'src/composables/viewpage.js';
	const props = defineProps({
		id: [String, Number],
		primaryKey: {
			type: String,
			default: 'id',
		},
		pageStoreKey: {
			type: String,
			default: 'SCHEDULE',
		},
		pageName: {
			type: String,
			default: 'schedule',
		},
		routeName: {
			type: String,
			default: 'scheduleview',
		},
		apiPath: {
			type: String,
			default: 'schedule/view',
		},
		editButton: {
			type: Boolean,
			default: true,
		},
		deleteButton: {
			type: Boolean,
			default: true,
		},
		exportButton: {
			type: Boolean,
			default: true,
		},
		titleBeforeDelete: {
			type: String,
			default: "Delete record",
		},
		msgBeforeDelete: {
			type: String,
			default: "Are you sure you want to delete this record?",
		},
		msgAfterDelete: {
			type: String,
			default: "Record deleted successfully",
		},
		showHeader: {
			type: Boolean,
			default: true,
		},
		showFooter: {
			type: Boolean,
			default: true,
		},
		isSubPage: {
			type : Boolean,
			default : false,
		}
	});
	
	const store = usePageStore(props.pageStoreKey);
	const app = useApp(props);
	const auth = useAuth();
	
	const page = useViewPage({store, props}); // where page logics resides
	
	const {  currentRecord } = toRefs(store.state);
	const { loading, pageReady } = toRefs(page.state);
	const item = currentRecord;
	
	const  { load, deleteItem, exportPage,   } = page.methods;
	
	function getActionMenuModel(data){
		return [
		{
			label: "Edit",
			command: (event) => { app.openPageDialog({ page:'schedule/edit', url: `/schedule/edit/${data.id}`, closeBtn: true }) },
			icon: "pi pi-pencil",
			visible: auth.canView('schedule/edit')
		},
		{
			label: "Delete",
			command: (event) => { deleteItem(data.id) },
			icon: "pi pi-trash",
			visible: auth.canView('schedule/delete')
		}
	]
	}
	
	onMounted(()=>{ 
		const pageTitle = "Detalles de horario";
		app.setPageTitle(props.routeName, pageTitle); // set browser page title
	});
	
</script>
<style scoped>
</style>
