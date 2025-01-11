<?php

namespace Database\Seeders;

use App\Models\Query;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $querys = [
            (object) [
                'id' => 1,
                'name' => 'Pedido',
                'sentence' => 'SET QUOTED_IDENTIFIER OFF;
                                SELECT
                                    "001" AS codempresa,
                                    "4" AS codtipodoc,
                                    ISNULL(t430_cm_pv_docto.f430_id_tipo_docto, "") as tipo_documento,
                                    ISNULL(t430_cm_pv_docto.f430_consec_docto, "") as numero_pedido,
                                    ISNULL(vend.f210_id,"") AS CodVendedor,
                                    ISNULL(t200_mm_terceros.f200_nit, "") as nit_cliente,
                                    ISNULL(t201_mm_clientes.f201_id_sucursal, "") as sucursal_cliente,
                                    ISNULL(FORMAT(t430_cm_pv_docto.f430_id_fecha,"yyyy-MM-dd", "en-us"), "") as fecha_pedido,
                                    ISNULL(FORMAT(DATEADD(DAY, t201_mm_clientes.f201_dia_maximo_factura, t430_cm_pv_docto.f430_id_fecha), "yyyy-MM-dd", "en-us"), "") AS fecha_vencimiento,
                                    ISNULL(t431_cm_pv_movto.f431_precio_unitario_base, 0) as precio_producto,
                                    "D" AS debcre,
                                    ISNULL(t150_mc_bodegas.f150_id, "") as bodega,
                                    ISNULL(RIGHT(""+CAST(f120_id AS VARCHAR(20)),20), "") as producto,
                                    ISNULL(t120_mc_items.f120_descripcion, "") AS descripcion_item,
                                    ISNULL(t431_cm_pv_movto.f431_cant1_pedida, "0") as cantidad_pedido,
                                    -- ISNULL(t431_cm_pv_movto.f431_vlr_bruto, "") as valor_bruto,
                                    (t431_cm_pv_movto.f431_vlr_bruto/iif((t431_cm_pv_movto.f431_cant_pedida_base*t431_cm_pv_movto.f431_factor)=0,1,(t431_cm_pv_movto.f431_cant_pedida_base*t431_cm_pv_movto.f431_factor))) as valor_bruto,
                                    ISNULL(t431_cm_pv_movto.f431_id_lista_precio, "0") as lista_precio,
                                    ISNULL(f430_rowid,"01") as idmovto,
                                    t431_cm_pv_movto.f431_factor as factor,
                                    "0" as peso,
                                    "" as volumen,
                                    ISNULL(f430_num_docto_referencia,"") AS tipoorigen,
                                    ISNULL(f430_referencia,"") AS consorigen,
                                    ISNULL(f431_id_motivo,"01") asmotorigen,
                                    "" as indnatori,
                                    ISNULL(f431_ind_obsequio,"0") as indobsori,
                                    "" as ind_obsequio_origen,
                                    t431_cm_pv_movto.f431_vlr_bruto AS vrbruto,
                                    t431_cm_pv_movto.f431_vlr_dscto_linea as vrdsctolin,
                                    iif(t431_cm_pv_movto.f431_vlr_bruto &lt;&gt; 0,(t431_cm_pv_movto.f431_vlr_dscto_linea/t431_cm_pv_movto.f431_vlr_bruto)*100,0) AS pordctolin,
                                    "" AS codprov,
                                    t431_cm_pv_movto.f431_rowid AS rowid,
                                    ISNULL(t430_cm_pv_docto.f430_id_co, "") as centro_operacion,
                                    "" as cargue,
                                    CONCAT(TRIM(t150_mc_bodegas.f150_id),"-",t430_cm_pv_docto.f430_id_tipo_docto,"-",t430_cm_pv_docto.f430_consec_docto) as documento_alterno,
                                    "" as tipofactura,
                                    "" as numfactura,
                                    IIF(ISNULL(t430_cm_pv_docto.f430_notas, "n1.1:") = "","n1.1:", ISNULL(t430_cm_pv_docto.f430_notas, "n1.1:")) as observaciones_pedido,
                                    CAST(ISNULL(f037_tasa,"0.00") AS VARCHAR(5)) AS iva,
                                    "" AS mensajewms,
                                    f431_vlr_imp_margen as ico

                                    -- ISNULL(t431_cm_pv_movto.f431_ind_estado, "") as estado_documento,
                                    -- ISNULL(t350_co_docto_contable.f350_id_tipo_docto, "") as tipo_doc_remision,
                                    -- ISNULL(t350_co_docto_contable.f350_consec_docto, "") as doc_remision,
                                    -- ISNULL(t430_cm_pv_docto.f430_id_co, "") as centro_operacion_bodega,
                                    -- ISNULL(t120_mc_items.f120_referencia, "") as codigo_ref_producto,
                                    -- ISNULL(t200_mm_terceros.f200_razon_social, "") as razon_cliente,
                                    -- ISNULL(t430_cm_pv_docto.f430_id_tipo_cli_fact, "") as tipo_cliente,
                                    -- ISNULL(t150_mc_bodegas.f150_descripcion, "") AS descripcion_bodega,
                                    -- ISNULL(f215_id, "000") as tipo_envio,
                                    -- ISNULL(CAST(t431_cm_pv_movto.f431_cant_comprometida_base as INT), 0) as cantidad_comprometido,
                                    -- ISNULL(CAST(f431_cant1_facturada as INT), 0) as cantidad_facturado,
                                    -- ISNULL(t431_cm_pv_movto.f431_id_unidad_medida, "") as unidad_medida,
                                    -- ISNULL(f201_id_cond_pago, "0") as condicion_pago,
                                    -- ISNULL(ter_vend.f200_nit,"") AS nitVendedor,

                                    -- IIF(t431_cm_pv_movto.f431_ind_estado = 2,"0", IIF(t431_cm_pv_movto.f431_ind_estado = 3, "0", IIF(ISNULL(t350_co_docto_contable.f350_consec_docto,"0") = 0,"0","factura"))) as estado,
                                    -- ISNULL(f215_descripcion,"") as descripcion_cliente

                                FROM
                                    t430_cm_pv_docto
                                    inner join t431_cm_pv_movto on (f430_rowid = f431_rowid_pv_docto) and f431_id_cia = f430_id_cia
                                    inner join t121_mc_items_extensiones on (f431_rowid_item_ext = f121_rowid) and f121_id_cia = f431_id_cia
                                    inner join t120_mc_items on (f121_rowid_item = f120_rowid) and f120_id_cia = f121_id_cia
                                    --inner join t124_mc_items_referencias on (f121_rowid_item = f124_rowid_item) and f121_id_cia = f124_id_cia
                                    inner join t150_mc_bodegas on (f431_rowid_bodega = f150_rowid) and f431_id_cia = f150_id_cia
                                    inner join t200_mm_terceros on (f430_rowid_tercero_fact = f200_rowid) and f200_id_cia = f430_id_cia
                                    left join t215_mm_puntos_envio_cliente on (f215_rowid_tercero = f200_rowid and f430_rowid_punto_envio_rem = f215_rowid and f200_id_cia = f215_id_cia)
                                    inner join t201_mm_clientes on (f200_rowid = f201_rowid_tercero AND f201_id_sucursal = f430_id_sucursal_fact)
                                    left join t460_cm_docto_remision_venta on (f430_rowid = f460_rowid_pv_docto) and f460_id_cia = f430_id_cia
                                        inner join t210_mm_vendedores as vend ON f430_rowid_tercero_vendedor = vend.f210_rowid_tercero and f430_id_cia = vend.f210_id_cia
                                    inner join t200_mm_terceros AS ter_vend ON f430_rowid_tercero_vendedor = ter_vend.f200_rowid and f430_id_cia = ter_vend.f200_id_cia
                                    left join t350_co_docto_contable on (f460_rowid_docto = f350_rowid) and f350_id_cia = f460_id_cia
                                    left join t207_mm_criterios_clientes
                                            ON ( f207_rowid_tercero  = t200_mm_terceros.f200_rowid AND f207_id_sucursal = f201_id_sucursal and f207_rowid_tercero = f201_rowid_tercero AND f207_id_cia = 1)
                                    LEFT JOIN t114_mc_grupos_impo_impuestos ON f114_id_cia = f120_id_cia
                                        and f114_grupo_impositivo = f120_id_grupo_impositivo
                                        and f114_id_clase_impuesto = 1
                                        and f114_ind_tipo_indicador = 1

                                    LEFT JOIN t037_mm_llaves_impuesto ON f037_id_cia = f114_id_cia
                                        and f037_id = f114_id_llave_impuesto
                                WHERE t431_cm_pv_movto.f431_id_cia = @Cia
                                    AND t431_cm_pv_movto.f431_ind_estado in (2) -- Consulta aprobados sin remision
                                    AND t430_cm_pv_docto.f430_id_tipo_docto = "PPM"
                                    AND f430_id_fecha BETWEEN DATEADD(MONTH, -2, GETDATE()) AND GETDATE()

                                ORDER BY t430_cm_pv_docto.f430_consec_docto,t430_cm_pv_docto.f430_id_co, RIGHT(""+CAST(f120_id AS VARCHAR(20)),20) ASC
                                OFFSET @Desde ROWS FETCH NEXT @Cuantos ROWS ONLY;
                                SET QUOTED_IDENTIFIER ON;',
                'from' => 0,
                'until' => 1000
            ],
        ];

        foreach($querys as $query) {
            Query::create([
                'id' => $query->id,
                'name' => $query->name,
                'sentence' => $query->sentence,
                'from' => $query->from,
                'until' => $query->until,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
