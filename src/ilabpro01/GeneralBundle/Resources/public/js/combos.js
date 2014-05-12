


    $("#list1").jCombo({ url: "getPaises.php" } );
    $("#list2").jCombo({ url: "getProvincias.php?id=",
					parent: "#list1"
				});		
    $("#list3").jCombo({ url: "getCiudades.php?id=",
					parent: "#list2"
				});

