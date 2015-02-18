<?php

class ShapesTableSeeder extends Seeder {

    public function run() {
        Shape::unguard();

        Shape::create([
            'id' => 3,
            'strip_id' => 4,
            'user_id' => 2,
            'validated_at' => '2015-02-17 15:54:31',
            'created_at' => '2015-02-17 15:45:31',
            'updated_at' => '2015-02-17 15:45:31',
            'value' => '{"objects":[{"type":"image","width":696,"height":938,"src":"/uploads/0/5d46295fe2f7127018786ae6185e4412","filters":[],"crossOrigin":"","alignX":"none","alignY":"none","meetOrSlice":"meet"},{"type":"path","originX":"center","originY":"center","left":365.12,"top":87.5,"width":77.83,"height":46,"fill":null,"stroke":"#ffffff","strokeWidth":20,"strokeLineCap":"round","strokeLineJoin":"round","path":[["M",347.5333251953125,70.5],["Q",347.5333251953125,70.5,348.0333251953125,70.5],["Q",348.5333251953125,70.5,348.2833251953125,70],["Q",348.0333251953125,69.5,347.5333251953125,69.5],["Q",347.0333251953125,69.5,345.0333251953125,69.5],["Q",343.0333251953125,69.5,341.0333251953125,69],["Q",339.0333251953125,68.5,336.5333251953125,68],["Q",334.0333251953125,67.5,331.5333251953125,67],["Q",329.0333251953125,66.5,328.0333251953125,66],["Q",327.0333251953125,65.5,326.5333251953125,65.5],["Q",326.0333251953125,65.5,327.0333251953125,65.5],["Q",328.0333251953125,65.5,329.5333251953125,65.5],["Q",331.0333251953125,65.5,333.0333251953125,65.5],["Q",335.0333251953125,65.5,337.0333251953125,65.5],["Q",339.0333251953125,65.5,340.5333251953125,65.5],["Q",342.0333251953125,65.5,344.0333251953125,65.5],["Q",346.0333251953125,65.5,348.0333251953125,65.5],["Q",350.0333251953125,65.5,352.0333251953125,65.5],["Q",354.0333251953125,65.5,355.0333251953125,65.5],["Q",356.0333251953125,65.5,357.0333251953125,65.5],["Q",358.0333251953125,65.5,358.5333251953125,65.5],["Q",359.0333251953125,65.5,359.5333251953125,65.5],["Q",360.0333251953125,65.5,360.5333251953125,65.5],["Q",361.0333251953125,65.5,361.5333251953125,65.5],["Q",362.0333251953125,65.5,362.5333251953125,65.5],["Q",363.0333251953125,65.5,364.0333251953125,65.5],["Q",365.0333251953125,65.5,365.5333251953125,65.5],["Q",366.0333251953125,65.5,367.0333251953125,65.5],["Q",368.0333251953125,65.5,368.5333251953125,65.5],["Q",369.0333251953125,65.5,369.5333251953125,65.5],["Q",370.0333251953125,65.5,370.0333251953125,65.5],["Q",370.0333251953125,65.5,370.5333251953125,65.5],["Q",371.0333251953125,65.5,371.5333251953125,65.5],["Q",372.0333251953125,65.5,372.5333251953125,65.5],["Q",373.0333251953125,65.5,373.5333251953125,65.5],["Q",374.0333251953125,65.5,374.5333251953125,65.5],["Q",375.0333251953125,65.5,375.5333251953125,65.5],["Q",376.0333251953125,65.5,376.5333251953125,65.5],["Q",377.0333251953125,65.5,377.5333251953125,65.5],["Q",378.0333251953125,65.5,378.5333251953125,65.5],["Q",379.0333251953125,65.5,380.0333251953125,65],["Q",381.0333251953125,64.5,382.0333251953125,64.5],["Q",383.0333251953125,64.5,383.5333251953125,64.5],["Q",384.0333251953125,64.5,384.5333251953125,64.5],["Q",385.0333251953125,64.5,386.0333251953125,64.5],["Q",387.0333251953125,64.5,388.0333251953125,64.5],["Q",389.0333251953125,64.5,389.5333251953125,64.5],["Q",390.0333251953125,64.5,391.5333251953125,64.5],["Q",393.0333251953125,64.5,393.0333251953125,65],["Q",393.0333251953125,65.5,393.0333251953125,66.5],["Q",393.0333251953125,67.5,392.0333251953125,69],["Q",391.0333251953125,70.5,390.5333251953125,71.5],["Q",390.0333251953125,72.5,389.5333251953125,73.5],["Q",389.0333251953125,74.5,388.5333251953125,75],["Q",388.0333251953125,75.5,388.0333251953125,76.5],["Q",388.0333251953125,77.5,388.0333251953125,78],["Q",388.0333251953125,78.5,388.0333251953125,79],["Q",388.0333251953125,79.5,387.5333251953125,79.5],["Q",387.0333251953125,79.5,386.5333251953125,79.5],["Q",386.0333251953125,79.5,385.5333251953125,79.5],["Q",385.0333251953125,79.5,384.0333251953125,79.5],["Q",383.0333251953125,79.5,382.0333251953125,79.5],["Q",381.0333251953125,79.5,379.5333251953125,79.5],["Q",378.0333251953125,79.5,376.0333251953125,79.5],["Q",374.0333251953125,79.5,372.5333251953125,79.5],["Q",371.0333251953125,79.5,369.0333251953125,79.5],["Q",367.0333251953125,79.5,366.5333251953125,79.5],["Q",366.0333251953125,79.5,365.5333251953125,79.5],["Q",365.0333251953125,79.5,364.0333251953125,79.5],["Q",363.0333251953125,79.5,361.5333251953125,79.5],["Q",360.0333251953125,79.5,358.0333251953125,79.5],["Q",356.0333251953125,79.5,354.5333251953125,79.5],["Q",353.0333251953125,79.5,351.5333251953125,79.5],["Q",350.0333251953125,79.5,349.5333251953125,79.5],["Q",349.0333251953125,79.5,348.5333251953125,79.5],["Q",348.0333251953125,79.5,347.5333251953125,79.5],["Q",347.0333251953125,79.5,346.5333251953125,80],["Q",346.0333251953125,80.5,345.5333251953125,81],["Q",345.0333251953125,81.5,344.0333251953125,83],["Q",343.0333251953125,84.5,341.5333251953125,85.5],["Q",340.0333251953125,86.5,339.5333251953125,88],["Q",339.0333251953125,89.5,338.5333251953125,90],["Q",338.0333251953125,90.5,337.5333251953125,91],["Q",337.0333251953125,91.5,337.0333251953125,92],["Q",337.0333251953125,92.5,337.0333251953125,93],["Q",337.0333251953125,93.5,337.0333251953125,93.5],["Q",337.0333251953125,93.5,337.0333251953125,94],["Q",337.0333251953125,94.5,336.5333251953125,94.5],["Q",336.0333251953125,94.5,335.5333251953125,95],["Q",335.0333251953125,95.5,334.5333251953125,96],["Q",334.0333251953125,96.5,333.5333251953125,97],["Q",333.0333251953125,97.5,332.5333251953125,97.5],["Q",332.0333251953125,97.5,331.5333251953125,97.5],["Q",331.0333251953125,97.5,331.0333251953125,97],["Q",331.0333251953125,96.5,331.0333251953125,95.5],["Q",331.0333251953125,94.5,330.5333251953125,94.5],["Q",330.0333251953125,94.5,330.0333251953125,93.5],["Q",330.0333251953125,92.5,330.0333251953125,92],["Q",330.0333251953125,91.5,329.5333251953125,91.5],["Q",329.0333251953125,91.5,328.5333251953125,91.5],["Q",328.0333251953125,91.5,328.0333251953125,92],["Q",328.0333251953125,92.5,328.0333251953125,93],["Q",328.0333251953125,93.5,327.5333251953125,97],["Q",327.0333251953125,100.5,327.0333251953125,101],["Q",327.0333251953125,101.5,327.0333251953125,102],["Q",327.0333251953125,102.5,327.0333251953125,103],["Q",327.0333251953125,103.5,327.5333251953125,103.5],["Q",328.0333251953125,103.5,328.5333251953125,103.5],["Q",329.0333251953125,103.5,329.5333251953125,103.5],["Q",330.0333251953125,103.5,330.5333251953125,103.5],["Q",331.0333251953125,103.5,331.5333251953125,103.5],["Q",332.0333251953125,103.5,332.0333251953125,103.5],["Q",332.0333251953125,103.5,332.5333251953125,103.5],["Q",333.0333251953125,103.5,333.0333251953125,104],["Q",333.0333251953125,104.5,333.5333251953125,104.5],["Q",334.0333251953125,104.5,334.5333251953125,104.5],["Q",335.0333251953125,104.5,335.5333251953125,104.5],["Q",336.0333251953125,104.5,338.0333251953125,104.5],["Q",340.0333251953125,104.5,341.5333251953125,104.5],["Q",343.0333251953125,104.5,344.5333251953125,104.5],["Q",346.0333251953125,104.5,347.5333251953125,104.5],["Q",349.0333251953125,104.5,350.0333251953125,104.5],["Q",351.0333251953125,104.5,352.0333251953125,104.5],["Q",353.0333251953125,104.5,354.0333251953125,104.5],["Q",355.0333251953125,104.5,355.5333251953125,104.5],["Q",356.0333251953125,104.5,356.5333251953125,104.5],["Q",357.0333251953125,104.5,358.5333251953125,104.5],["Q",360.0333251953125,104.5,360.5333251953125,104.5],["Q",361.0333251953125,104.5,362.5333251953125,104.5],["Q",364.0333251953125,104.5,365.0333251953125,104.5],["Q",366.0333251953125,104.5,367.5333251953125,104.5],["Q",369.0333251953125,104.5,370.0333251953125,104],["Q",371.0333251953125,103.5,371.5333251953125,103.5],["Q",372.0333251953125,103.5,372.5333251953125,103.5],["Q",373.0333251953125,103.5,374.0333251953125,103.5],["Q",375.0333251953125,103.5,376.0333251953125,103],["Q",377.0333251953125,102.5,379.0333251953125,102.5],["Q",381.0333251953125,102.5,381.5333251953125,102.5],["Q",382.0333251953125,102.5,383.0333251953125,102.5],["Q",384.0333251953125,102.5,384.5333251953125,102.5],["Q",385.0333251953125,102.5,386.0333251953125,102],["Q",387.0333251953125,101.5,387.5333251953125,101.5],["Q",388.0333251953125,101.5,388.5333251953125,101.5],["Q",389.0333251953125,101.5,389.5333251953125,101.5],["Q",390.0333251953125,101.5,390.5333251953125,101.5],["Q",391.0333251953125,101.5,392.0333251953125,101],["Q",393.0333251953125,100.5,393.0333251953125,100.5],["Q",393.0333251953125,100.5,394.0333251953125,100.5],["Q",395.0333251953125,100.5,396.5333251953125,100.5],["Q",398.0333251953125,100.5,399.0333251953125,100],["Q",400.0333251953125,99.5,400.5333251953125,99.5],["Q",401.0333251953125,99.5,401.0333251953125,99.5],["Q",401.0333251953125,99.5,401.5333251953125,99],["Q",402.0333251953125,98.5,402.0333251953125,98],["Q",402.0333251953125,97.5,402.5333251953125,97.5],["Q",403.0333251953125,97.5,403.0333251953125,97],["Q",403.0333251953125,96.5,403.0333251953125,97],["Q",403.0333251953125,97.5,403.0333251953125,99],["Q",403.0333251953125,100.5,402.0333251953125,101.5],["Q",401.0333251953125,102.5,400.5333251953125,104],["Q",400.0333251953125,105.5,399.5333251953125,106.5],["Q",399.0333251953125,107.5,399.0333251953125,108],["Q",399.0333251953125,108.5,398.5333251953125,109],["Q",398.0333251953125,109.5,397.5333251953125,109.5],["Q",397.0333251953125,109.5,397.0333251953125,110],["Q",397.0333251953125,110.5,397.0333251953125,110.5],["Q",397.0333251953125,110.5,397.5333251953125,110],["Q",398.0333251953125,109.5,398.0333251953125,109],["Q",398.0333251953125,108.5,398.5333251953125,108.5],["Q",399.0333251953125,108.5,399.5333251953125,107.5],["Q",400.0333251953125,106.5,401.0333251953125,106],["Q",402.0333251953125,105.5,402.5333251953125,105],["Q",403.0333251953125,104.5,403.0333251953125,104],["Q",403.0333251953125,103.5,403.5333251953125,102.5],["Q",404.0333251953125,101.5,404.0333251953125,101.5],["Q",404.0333251953125,101.5,404.0333251953125,101],["Q",404.0333251953125,100.5,404.0333251953125,100],["Q",404.0333251953125,99.5,404.0333251953125,99],["Q",404.0333251953125,98.5,404.0333251953125,98],["Q",404.0333251953125,97.5,404.0333251953125,97.5],["Q",404.0333251953125,97.5,404.0333251953125,96.5],["Q",404.0333251953125,95.5,404.0333251953125,95.5],["Q",404.0333251953125,95.5,404.0333251953125,95],["Q",404.0333251953125,94.5,403.5333251953125,94.5],["Q",403.0333251953125,94.5,402.0333251953125,94.5],["Q",401.0333251953125,94.5,399.0333251953125,94.5],["Q",397.0333251953125,94.5,394.5333251953125,94.5],["Q",392.0333251953125,94.5,390.0333251953125,94.5],["Q",388.0333251953125,94.5,386.5333251953125,94.5],["Q",385.0333251953125,94.5,383.5333251953125,94.5],["Q",382.0333251953125,94.5,380.5333251953125,94.5],["Q",379.0333251953125,94.5,378.0333251953125,94.5],["Q",377.0333251953125,94.5,375.5333251953125,94.5],["Q",374.0333251953125,94.5,373.0333251953125,94.5],["Q",372.0333251953125,94.5,371.0333251953125,94.5],["Q",370.0333251953125,94.5,369.5333251953125,94.5],["Q",369.0333251953125,94.5,368.5333251953125,94.5],["Q",368.0333251953125,94.5,367.5333251953125,94.5],["Q",367.0333251953125,94.5,366.5333251953125,94.5],["Q",366.0333251953125,94.5,365.0333251953125,94.5],["Q",364.0333251953125,94.5,363.0333251953125,95],["Q",362.0333251953125,95.5,361.0333251953125,95.5],["Q",360.0333251953125,95.5,359.5333251953125,95.5],["Q",359.0333251953125,95.5,358.0333251953125,95.5],["Q",357.0333251953125,95.5,357.0333251953125,95.5],["Q",357.0333251953125,95.5,357.0333251953125,96],["Q",357.0333251953125,96.5,356.5333251953125,96.5],["Q",356.0333251953125,96.5,355.5333251953125,96.5],["Q",355.0333251953125,96.5,354.5333251953125,96.5],["Q",354.0333251953125,96.5,353.5333251953125,96.5],["Q",353.0333251953125,96.5,352.5333251953125,97.5],["Q",352.0333251953125,98.5,351.0333251953125,98.5],["Q",350.0333251953125,98.5,349.5333251953125,98.5],["Q",349.0333251953125,98.5,348.5333251953125,98.5],["L",348.0333251953125,98.5]],"pathOffset":{"x":365.1191116329394,"y":87.5}},{"type":"path","originX":"center","originY":"center","left":114.03,"top":673.5,"width":1,"fill":null,"stroke":"#ffffff","strokeWidth":20,"strokeLineCap":"round","strokeLineJoin":"round","path":[["M",113.5333251953125,673.5],["Q",113.5333251953125,673.5,114.0333251953125,673.5],["L",114.5333251953125,673.5]],"pathOffset":{"x":114.0333251953125,"y":673.5}},{"type":"path","originX":"center","originY":"center","left":141.78,"top":676,"width":48.5,"height":5,"fill":null,"stroke":"#ffffff","strokeWidth":20,"strokeLineCap":"round","strokeLineJoin":"round","path":[["M",117.5333251953125,673.5],["Q",117.5333251953125,673.5,118.0333251953125,673.5],["Q",118.5333251953125,673.5,118.7833251953125,673.5],["Q",119.0333251953125,673.5,119.5333251953125,673.5],["Q",120.0333251953125,673.5,121.0333251953125,673.5],["Q",122.0333251953125,673.5,123.5333251953125,673.5],["Q",125.0333251953125,673.5,125.5333251953125,673.5],["Q",126.0333251953125,673.5,127.0333251953125,673.5],["Q",128.0333251953125,673.5,128.5333251953125,673.5],["Q",129.0333251953125,673.5,130.0333251953125,673.5],["Q",131.0333251953125,673.5,131.5333251953125,673.5],["Q",132.0333251953125,673.5,132.5333251953125,673.5],["Q",133.0333251953125,673.5,133.5333251953125,673.5],["Q",134.0333251953125,673.5,134.5333251953125,673.5],["Q",135.0333251953125,673.5,135.5333251953125,673.5],["Q",136.0333251953125,673.5,136.5333251953125,673.5],["Q",137.0333251953125,673.5,137.5333251953125,673.5],["Q",138.0333251953125,673.5,139.0333251953125,673.5],["Q",140.0333251953125,673.5,140.5333251953125,673.5],["Q",141.0333251953125,673.5,141.5333251953125,673.5],["Q",142.0333251953125,673.5,143.0333251953125,673.5],["Q",144.0333251953125,673.5,144.5333251953125,673.5],["Q",145.0333251953125,673.5,145.5333251953125,673.5],["Q",146.0333251953125,673.5,148.0333251953125,673.5],["Q",150.0333251953125,673.5,150.5333251953125,673.5],["Q",151.0333251953125,673.5,152.0333251953125,674.5],["Q",153.0333251953125,675.5,153.0333251953125,675.5],["Q",153.0333251953125,675.5,153.5333251953125,675.5],["Q",154.0333251953125,675.5,155.0333251953125,676],["Q",156.0333251953125,676.5,157.0333251953125,676.5],["Q",158.0333251953125,676.5,158.5333251953125,677],["Q",159.0333251953125,677.5,160.0333251953125,677.5],["Q",161.0333251953125,677.5,161.5333251953125,678],["Q",162.0333251953125,678.5,162.5333251953125,678.5],["Q",163.0333251953125,678.5,163.5333251953125,678.5],["Q",164.0333251953125,678.5,164.0333251953125,678.5],["Q",164.0333251953125,678.5,165.0333251953125,678.5],["L",166.0333251953125,678.5]],"pathOffset":{"x":141.7833251953125,"y":676}},{"type":"path","originX":"center","originY":"center","left":142.03,"top":682.5,"width":1,"fill":null,"stroke":"#ffffff","strokeWidth":20,"strokeLineCap":"round","strokeLineJoin":"round","path":[["M",141.5333251953125,682.5],["Q",141.5333251953125,682.5,142.0333251953125,682.5],["L",142.5333251953125,682.5]],"pathOffset":{"x":142.0333251953125,"y":682.5}},{"type":"path","originX":"center","originY":"center","left":164.03,"top":682.5,"width":1,"fill":null,"stroke":"#ffffff","strokeWidth":20,"strokeLineCap":"round","strokeLineJoin":"round","path":[["M",163.5333251953125,682.5],["Q",163.5333251953125,682.5,164.0333251953125,682.5],["L",164.5333251953125,682.5]],"pathOffset":{"x":164.0333251953125,"y":682.5}},{"type":"path","originX":"center","originY":"center","left":177.03,"top":677.5,"width":1,"fill":null,"stroke":"#ffffff","strokeWidth":20,"strokeLineCap":"round","strokeLineJoin":"round","path":[["M",176.5333251953125,677.5],["Q",176.5333251953125,677.5,177.0333251953125,677.5],["L",177.5333251953125,677.5]],"pathOffset":{"x":177.0333251953125,"y":677.5}},{"type":"path","originX":"center","originY":"center","left":183.03,"top":677.5,"width":1,"fill":null,"stroke":"#ffffff","strokeWidth":20,"strokeLineCap":"round","strokeLineJoin":"round","path":[["M",182.5333251953125,677.5],["Q",182.5333251953125,677.5,183.0333251953125,677.5],["L",183.5333251953125,677.5]],"pathOffset":{"x":183.0333251953125,"y":677.5}},{"type":"path","originX":"center","originY":"center","left":188.03,"top":676.5,"width":1,"fill":null,"stroke":"#ffffff","strokeWidth":20,"strokeLineCap":"round","strokeLineJoin":"round","path":[["M",187.5333251953125,676.5],["Q",187.5333251953125,676.5,188.0333251953125,676.5],["L",188.5333251953125,676.5]],"pathOffset":{"x":188.0333251953125,"y":676.5}}],"background":""}',
        ]);

        Shape::create([
            'id' => 4,
            'strip_id' => 13,
            'user_id' => 3,
            'created_at' => '2015-02-18 09:31:42',
            'updated_at' => '2015-02-18 09:31:42',
            'validated_at' => '2015-02-18 09:48:38',
            'user_id' => 3,
            'value' => '{"objects":[{"type":"image","width":696,"height":938,"src":"/uploads/0/4add9b73d5ab647ee47aebcd0438eb30","filters":[],"crossOrigin":"","alignX":"none","alignY":"none","meetOrSlice":"meet"},{"type":"ellipse","left":130,"top":218.5,"width":164,"height":76,"fill":"#ffffff","rx":82,"ry":38},{"type":"ellipse","left":44,"top":614.5,"fill":"#ffffff","rx":0,"ry":0},{"type":"ellipse","left":9,"top":579.42,"width":162,"height":78,"fill":"#ffffff","scaleX":0.8,"scaleY":0.8,"rx":81,"ry":39},{"type":"ellipse","left":142,"top":833.5,"width":158,"height":8,"fill":"#ffffff","scaleX":0.89,"scaleY":7.63,"rx":79,"ry":4},{"type":"ellipse","left":428,"top":766.5,"width":148,"height":50,"fill":"#ffffff","scaleX":0.8,"rx":74,"ry":25},{"type":"ellipse","left":627,"top":675.5,"width":46,"height":30,"fill":"#ffffff","rx":23,"ry":15}],"background":""}'
        ]);
    }

}
