import * as $ from 'jquery';
import 'datatables';

export default (function () {
  $('#dataTable,#dataTable1,#dataTable2,#dataTable3,#dataTable4,#dataTable5, #dataTable6').DataTable({
		language: {

			'url' : 'https://cdn.datatables.net/plug-ins/1.12.0/i18n/ar.json'
			// More languages : http://www.datatables.net/plug-ins/i18n/


		},


		aaSorting: []
	});
}());
