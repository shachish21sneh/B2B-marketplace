<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Supplier;
use App\Models\SupplierDocument;
use App\Models\SubscriptionPlan;
use App\Models\Subscription;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Location;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

$premiumPlan = SubscriptionPlan::where('slug', 'enterprise-elite')->first() ?? SubscriptionPlan::first();
$businessPlan = SubscriptionPlan::where('slug', 'business-pro')->first() ?? SubscriptionPlan::first();

$upCitiesList = [
    [
        'city' => 'Prayagraj', 'pincode' => '211001', 'image' => 'https://images.unsplash.com/photo-1596176530529-78163a4f7af2?w=500&auto=format&fit=crop&q=80',
        's1' => [
            'name' => 'Alok Nath Tripathi', 'company' => 'Prayag Precision Pipes & Industrial Tubes Ltd', 'type' => 'Manufacturer', 'cat' => 'construction-steel-piping',
            'gst' => '09AAACP1122D1Z4', 'address' => 'Naini Industrial Area Phase 1',
            'desc' => 'Leading manufacturer of ERW galvanized steel pipes, MS hollow sections, and heavy industrial conduit tubing for infrastructure and irrigation projects in Uttar Pradesh.',
            'prod' => 'ERW Galvanized Steel Pipes & Structural Tubes', 'price' => 64500, 'unit' => 'Ton', 'moq' => 5,
            'pdesc' => 'High tensile IS 1239 / IS 3589 compliant hot dip galvanized round and square steel pipes with anti-corrosion zinc coating.',
            'specs' => ['Outer Diameter' => '15mm - 300mm', 'Thickness' => '2.0mm - 8.0mm', 'Standard' => 'IS 1239 / IS 3589', 'Zinc Coating' => '360 GSM Hot Dip'],
            'pimg' => 'https://images.unsplash.com/photo-1504917599217-d4dc5ebe6122?w=600&auto=format&fit=crop&q=80'
        ],
        's2' => [
            'name' => 'Dinesh Kumar Mishra', 'company' => 'Triveni Heavy Power Cables & Switchgears', 'type' => 'Manufacturer', 'cat' => 'electrical-electronics-cables',
            'gst' => '09AAACT3344K1Z7', 'address' => 'Phaphamau Industrial Estate',
            'desc' => 'Manufacturing high-performance XLPE armoured underground cables, LT/HT switchgear panels, and copper busbars for state utilities and heavy industries.',
            'prod' => 'Armoured XLPE Underground High-Tension Cables', 'price' => 280, 'unit' => 'Meter', 'moq' => 500,
            'pdesc' => '11kV/33kV multi-core aluminium conductor XLPE insulated steel tape armoured heavy power transmission cable.',
            'specs' => ['Voltage Grade' => '1.1kV to 33kV', 'Conductor' => 'Electrolytic Grade Aluminum', 'Armouring' => 'Galvanized Steel Strip / Wire', 'Standard' => 'IS 7098 Part 2'],
            'pimg' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=600&auto=format&fit=crop&q=80'
        ]
    ],
    [
        'city' => 'Varanasi', 'pincode' => '221001', 'image' => 'https://images.unsplash.com/photo-1561361513-2d000a50f0dc?w=500&auto=format&fit=crop&q=80',
        's1' => [
            'name' => 'Mukund Das Agrawal', 'company' => 'Kashi Heritage Silk Mills & Handlooms', 'type' => 'Manufacturer', 'cat' => 'textiles-fabrics-workwear',
            'gst' => '09AAACK4455P1Z2', 'address' => 'Chowk Silk Market Complex',
            'desc' => 'Authentic manufacturer of pure Banarasi Katan silk brocades, zari jacquard fabrics, and premium handloom bridal textiles for wholesale export.',
            'prod' => 'Pure Banarasi Katan Silk Brocade Wholesale Fabric', 'price' => 1450, 'unit' => 'Meter', 'moq' => 100,
            'pdesc' => 'Handwoven pure mulberry silk fabric featuring intricate gold zari floral motifs and traditional kadwa weaving craft.',
            'specs' => ['Material' => '100% Pure Katan Mulberry Silk', 'Width' => '44 Inches', 'Craft' => 'Handloom Zari Kadwa', 'GSM' => '120 GSM'],
            'pimg' => 'https://images.unsplash.com/photo-1617627143750-d86bc21e42bb?w=600&auto=format&fit=crop&q=80'
        ],
        's2' => [
            'name' => 'Ramesh Chandra Jaiswal', 'company' => 'Banaras Precision Submersible Pumps & Motors', 'type' => 'Manufacturer', 'cat' => 'industrial-machinery',
            'gst' => '09AAACB7788M1Z9', 'address' => 'Ramnagar Industrial Area Phase 2',
            'desc' => 'High efficiency agricultural water pumps, stainless steel multi-stage submersible pumps, and industrial cooling motors engineered for continuous duty.',
            'prod' => '10 HP Stainless Steel Borewell Submersible Pump', 'price' => 24500, 'unit' => 'Set', 'moq' => 5,
            'pdesc' => '100% copper wound water filled 10 HP submersible pump with dynamically balanced rotors for deep bore agricultural irrigation.',
            'specs' => ['Power' => '10 HP / 7.5 kW', 'Head Range' => '60 - 180 Meters', 'Outlet Size' => '65mm / 2.5 Inch', 'Material' => 'SS 304 Impeller & Bowl'],
            'pimg' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=600&auto=format&fit=crop&q=80'
        ]
    ],
    [
        'city' => 'Chandauli', 'pincode' => '232104', 'image' => 'https://images.unsplash.com/photo-1570168007204-dfb528c6958f?w=500&auto=format&fit=crop&q=80',
        's1' => [
            'name' => 'Sanjay Singh', 'company' => 'Chandauli Agro Milling & Grain Processing Units', 'type' => 'Manufacturer', 'cat' => 'agriculture-food-processing',
            'gst' => '09AAACC8899Q1Z1', 'address' => 'Industrial Area Mugalsarai Road',
            'desc' => 'Operating high capacity Buhler Sortex rice mills supplying export quality non-basmati, Sona Masoori, and parboiled rice across India.',
            'prod' => 'Sortex Cleaned Sona Masoori & Non-Basmati Rice', 'price' => 38, 'unit' => 'Kg', 'moq' => 5000,
            'pdesc' => '100% Sortex cleaned premium silky polished non-basmati grain with under 5% broken grain ratio packed in 50kg PP bags.',
            'specs' => ['Grain Length' => '5.2mm Average', 'Moisture' => '< 13.5%', 'Broken' => '< 4%', 'Packaging' => '25kg / 50kg Brand Bags'],
            'pimg' => 'https://images.unsplash.com/photo-1586201375761-83865001e31c?w=600&auto=format&fit=crop&q=80'
        ],
        's2' => [
            'name' => 'Anil Kumar Yadav', 'company' => 'Purvanchal Industrial Storage Silos & Tanks', 'type' => 'Manufacturer', 'cat' => 'packaging-materials-containers',
            'gst' => '09AAACP6655L1Z8', 'address' => 'Alinagar Bypass Road Industrial Zone',
            'desc' => 'Fabrication of heavy galvanized grain storage silos, stainless steel bulk milk tanks, and chemical holding pressure vessels.',
            'prod' => 'Galvanized Corrugated Grain Storage Silos 50MT', 'price' => 340000, 'unit' => 'Unit', 'moq' => 1,
            'pdesc' => 'Corrugated hot dipped galvanized steel hopper bottom grain silo with aeration fan and temperature sensing cables.',
            'specs' => ['Capacity' => '50 Metric Tons', 'Steel Coating' => 'Z350 Hot Dip Galvanized', 'Discharge' => 'Hopper Bottom 45 Degree', 'Diameter' => '4.2 Meters'],
            'pimg' => 'https://images.unsplash.com/photo-1581092580497-e0d23cbdf1dc?w=600&auto=format&fit=crop&q=80'
        ]
    ],
    [
        'city' => 'Ghazipur', 'pincode' => '233001', 'image' => 'https://images.unsplash.com/photo-1587474260584-136574528ed5?w=500&auto=format&fit=crop&q=80',
        's1' => [
            'name' => 'Krishnakant Rai', 'company' => 'Ghazipur Natural Aromatics & Herbal Extracts', 'type' => 'Manufacturer', 'cat' => 'chemicals-polymers-plastics',
            'gst' => '09AAACG7711N1Z5', 'address' => 'Ghat Road Industrial Complex',
            'desc' => 'Steam distillation extraction of Gulab Jal (rose water), vetiver khas attar, and therapeutic phytochemical extracts for perfumery & cosmetic industries.',
            'prod' => 'Pure Rose Water Distillate & Natural Essential Extracts', 'price' => 450, 'unit' => 'Liter', 'moq' => 100,
            'pdesc' => 'Hydro-distilled pure Rosa damascena floral water without alcohol or artificial stabilizers in food-grade HDPE barrels.',
            'specs' => ['Purity' => '100% Pure Hydro-Distillate', 'Grade' => 'Cosmetic / Pharma Grade', 'Preservatives' => 'Nil (Natural Autoclaved)', 'Packaging' => '50L / 200L Drums'],
            'pimg' => 'https://images.unsplash.com/photo-1535585209827-a15fcdbc4c2d?w=600&auto=format&fit=crop&q=80'
        ],
        's2' => [
            'name' => 'Virendra Pratap Rai', 'company' => 'Ghazipur Agricultural Sprayers & Farm Tools', 'type' => 'Manufacturer', 'cat' => 'industrial-machinery',
            'gst' => '09AAACG8822K1Z3', 'address' => 'Zamania Industrial Zone',
            'desc' => 'Manufacturing manual and battery powered knapsack crop sprayers, high-pressure brass nozzles, and drip fertigation equipment.',
            'prod' => '16L Battery Operated Agriculture Knapsack Sprayer', 'price' => 1850, 'unit' => 'Piece', 'moq' => 20,
            'pdesc' => 'Heavy duty 12V 12Ah lithium-ion powered knapsack sprayer with dual motor pressure pump and telescopic stainless steel lance.',
            'specs' => ['Tank Capacity' => '16 Liters UV HDPE', 'Battery' => '12V 12Ah Rechargeable', 'Working Pressure' => '0.2 - 0.45 MPa', 'Discharge Rate' => '3.1 L/Min'],
            'pimg' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=600&auto=format&fit=crop&q=80'
        ]
    ],
    [
        'city' => 'Jaunpur', 'pincode' => '222001', 'image' => 'https://images.unsplash.com/photo-1606820245089-b1d5c5896a2f?w=500&auto=format&fit=crop&q=80',
        's1' => [
            'name' => 'Ashok Kumar Gupta', 'company' => 'Jaunpur Brass Die-Casting & Heavy Metal Works', 'type' => 'Manufacturer', 'cat' => 'hardware-sanitaryware-pipes',
            'gst' => '09AAACJ3311E1Z8', 'address' => 'Siddhikpur Industrial Area',
            'desc' => 'High pressure die casting of brass plumbing ball valves, CP fittings, industrial bushes, and precision metal sanitary hardware.',
            'prod' => 'Forged Brass Plumbing Ball Valves & Couplings', 'price' => 165, 'unit' => 'Piece', 'moq' => 200,
            'pdesc' => 'Forged CW617N brass full-bore water ball valve with PTFE sealing seat, chrome plated brass ball and steel handle.',
            'specs' => ['Size' => '1/2 Inch to 2 Inch', 'Pressure' => 'PN 25 Bar', 'Temperature' => '-20°C to 120°C', 'Thread' => 'BSP / NPT'],
            'pimg' => 'https://images.unsplash.com/photo-1581092580497-e0d23cbdf1dc?w=600&auto=format&fit=crop&q=80'
        ],
        's2' => [
            'name' => 'Mahesh Chandra Maurya', 'company' => 'Gomti Agro Processors & Mustard Oil Mills', 'type' => 'Manufacturer', 'cat' => 'agriculture-food-processing',
            'gst' => '09AAACG4422D1Z6', 'address' => 'Shahganj Road Agro Hub',
            'desc' => 'Traditional cold pressed kachi ghani mustard oil expellers and high purity animal feed mustard cake flakes.',
            'prod' => 'Cold Pressed Kachi Ghani Mustard Oil 15L Tin', 'price' => 1950, 'unit' => 'Tin', 'moq' => 50,
            'pdesc' => '100% pure cold pressed mustard seed oil rich in natural pungency (allyl isothiocyanate) and omega-3 fatty acids in food-grade tin containers.',
            'specs' => ['Purity' => '100% Cold Expelled', 'Pungency' => 'High Natural Zing', 'FFA' => '< 0.8%', 'Packaging' => '15 Liter Sealed Tin Container'],
            'pimg' => 'https://images.unsplash.com/photo-1586201375761-83865001e31c?w=600&auto=format&fit=crop&q=80'
        ]
    ],
    [
        'city' => 'Azamgarh', 'pincode' => '276001', 'image' => 'https://images.unsplash.com/photo-1582510003544-4d00b7f74220?w=500&auto=format&fit=crop&q=80',
        's1' => [
            'name' => 'Mohd Tariq Ansari', 'company' => 'Mubarakpur Jacquard Weaving & Silk Mills', 'type' => 'Manufacturer', 'cat' => 'textiles-fabrics-workwear',
            'gst' => '09AAACM5511R1Z9', 'address' => 'Mubarakpur Weaving Cluster',
            'desc' => 'Renowned for high speed jacquard weaving of silk and synthetic dress fabrics, sarees, and decorative brocade furnishings.',
            'prod' => 'Polyester Jacquard Dress Materials & Saree Fabric', 'price' => 240, 'unit' => 'Meter', 'moq' => 250,
            'pdesc' => 'High density micro polyester jacquard woven fabric with metallic gold lurex threads and anti-wrinkle finishing.',
            'specs' => ['Width' => '44 / 54 Inches', 'Weave' => 'Jacquard Dobby', 'Composition' => '90% Poly + 10% Lurex', 'Weight' => '160 GSM'],
            'pimg' => 'https://images.unsplash.com/photo-1617627143750-d86bc21e42bb?w=600&auto=format&fit=crop&q=80'
        ],
        's2' => [
            'name' => 'Sunil Kumar Vishwakarma', 'company' => 'Azamgarh CNC Auto Components & Die Works', 'type' => 'Manufacturer', 'cat' => 'automotive-ev-transport',
            'gst' => '09AAACA6622P1Z7', 'address' => 'Belisa Industrial Area',
            'desc' => 'Machining of alloy steel transmission shafts, gear pinions, and high tonnage sheet metal press stamping components.',
            'prod' => 'Automotive Transmission Shafts & Precision Pinions', 'price' => 420, 'unit' => 'Piece', 'moq' => 100,
            'pdesc' => 'Case carburized 20MnCr5 alloy steel precision spline transmission shafts induction hardened to 58-62 HRC.',
            'specs' => ['Material' => '20MnCr5 / EN353', 'Tolerance' => '±0.005 mm', 'Hardness' => '58 - 62 HRC', 'Process' => 'CNC Turning + Spline Hobbing'],
            'pimg' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=600&auto=format&fit=crop&q=80'
        ]
    ],
    [
        'city' => 'Ballia', 'pincode' => '277001', 'image' => 'https://images.unsplash.com/photo-1599661046289-e31897846e41?w=500&auto=format&fit=crop&q=80',
        's1' => [
            'name' => 'Brijesh Singh', 'company' => 'Ballia Solar Power Panels & Lighting Systems', 'type' => 'Manufacturer', 'cat' => 'solar-renewable-energy',
            'gst' => '09AAACB9911L1Z3', 'address' => 'Bhrigu Ashram Industrial Estate',
            'desc' => 'Manufacturing high efficiency mono PERC solar photovoltaic panels, MPPT solar streetlights, and agricultural solar tube well drivers.',
            'prod' => '540W Mono PERC Bifacial Solar PV Modules', 'price' => 11200, 'unit' => 'Piece', 'moq' => 10,
            'pdesc' => 'Tier-1 certified 144 half-cut cells bifacial mono crystalline solar panel with 21.4% module efficiency and 25-year performance warranty.',
            'specs' => ['Peak Power' => '540 Watts', 'Efficiency' => '21.4%', 'Glass' => '3.2mm Toughened Solar Glass', 'Certifications' => 'BIS / IEC 61215'],
            'pimg' => 'https://images.unsplash.com/photo-1509391365360-2e959784a276?w=600&auto=format&fit=crop&q=80'
        ],
        's2' => [
            'name' => 'Rajendra Prasad Ojha', 'company' => 'Bhrigu Woven Sacks & Jute Packing Co', 'type' => 'Manufacturer', 'cat' => 'packaging-materials-containers',
            'gst' => '09AAACB1133F1Z1', 'address' => 'Rasra Industrial Road',
            'desc' => 'PP/HDPE woven sack bags, laminated fertilizer bags, and heavy duty jute gunny bags for bulk grain transport.',
            'prod' => 'HDPE/PP Laminated Heavy Grain Packaging Sacks 50kg', 'price' => 18.5, 'unit' => 'Piece', 'moq' => 2000,
            'pdesc' => 'UV stabilized woven polypropylene 50kg grain packaging bags with BOPP multi-color photo print and hemmed mouth.',
            'specs' => ['Capacity' => '50 Kg Grains / Fertilizer', 'GSM' => '75 - 90 GSM', 'Lamination' => 'BOPP Film Laminated', 'Mesh' => '10x10 Weave'],
            'pimg' => 'https://images.unsplash.com/photo-1586201375761-83865001e31c?w=600&auto=format&fit=crop&q=80'
        ]
    ],
    [
        'city' => 'Mau', 'pincode' => '275101', 'image' => 'https://images.unsplash.com/photo-1616088410192-39c4d6836423?w=500&auto=format&fit=crop&q=80',
        's1' => [
            'name' => 'Haji Mukhtar Ahmad', 'company' => 'Mau High-Count Yarn & Powerloom Fabrics Ltd', 'type' => 'Manufacturer', 'cat' => 'textiles-fabrics-workwear',
            'gst' => '09AAACM2211C1Z4', 'address' => 'Kopaganj Weaving Hub',
            'desc' => 'Integrated spinning and weaving facility producing combed cotton weaving yarn, plain grey fabrics, and garment lining textiles.',
            'prod' => '100% Combed Cotton Ring Spun Weaving Yarn 30s/40s', 'price' => 265, 'unit' => 'Kg', 'moq' => 500,
            'pdesc' => 'High tenacity autoconed and spliced combed cotton yarn wound on paper cones for high-speed airjet and shuttleless looms.',
            'specs' => ['Count' => '30s / 40s Ne Combed', 'CSP' => '> 2800', 'Fiber' => '100% MCU-5 Indian Cotton', 'Packaging' => 'Cartons with 24 Cones (45kg)'],
            'pimg' => 'https://images.unsplash.com/photo-1617627143750-d86bc21e42bb?w=600&auto=format&fit=crop&q=80'
        ],
        's2' => [
            'name' => 'Prabhat Sharma', 'company' => 'Sharda Technical Textiles & Waterproof Tarpaulins', 'type' => 'Manufacturer', 'cat' => 'packaging-materials-containers',
            'gst' => '09AAACS3322D1Z2', 'address' => 'Tajopur Industrial Zone',
            'desc' => 'Manufacturing heavy multilayer HDPE laminated waterproof truck tarpaulins, pond liners, and agricultural grain covers.',
            'prod' => 'Heavy Duty HDPE Waterproof Truck Tarpaulins 250 GSM', 'price' => 2200, 'unit' => 'Piece', 'moq' => 25,
            'pdesc' => '100% virgin HDPE waterproof tarp with reinforced heat sealed rope hems and aluminum eyelets at 3-foot intervals.',
            'specs' => ['Size' => '24 x 18 Feet', 'GSM' => '250 GSM Heavy Cross Laminated', 'Eyelets' => 'Rustproof Aluminium Every 1m', 'Color' => 'Olive Green / Blue'],
            'pimg' => 'https://images.unsplash.com/photo-1586201375761-83865001e31c?w=600&auto=format&fit=crop&q=80'
        ]
    ],
    [
        'city' => 'Gorakhpur', 'pincode' => '273001', 'image' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=500&auto=format&fit=crop&q=80',
        's1' => [
            'name' => 'Kishan Lal Agarwal', 'company' => 'Gorakhpur Steel Rerolling & TMT Bars Ltd', 'type' => 'Manufacturer', 'cat' => 'construction-steel-piping',
            'gst' => '09AAACG5544J1Z8', 'address' => 'GIDA Industrial Sector 13',
            'desc' => 'Modern automated rolling mill manufacturing primary billet Fe-550D TMT reinforcement bars and structural steel channels.',
            'prod' => 'Fe-550D High Ductility Earthquake Resistant TMT Bars', 'price' => 58500, 'unit' => 'Ton', 'moq' => 10,
            'pdesc' => 'Thermo-mechanically treated reinforcement steel bars with low carbon equivalent and high rib area for bonding with concrete.',
            'specs' => ['Grade' => 'Fe-550D IS:1786', 'Diameter Range' => '8mm to 32mm', 'Yield Strength' => '> 550 N/mm²', 'Elongation' => '> 14.5%'],
            'pimg' => 'https://images.unsplash.com/photo-1504917599217-d4dc5ebe6122?w=600&auto=format&fit=crop&q=80'
        ],
        's2' => [
            'name' => 'Narendra Pratap Singh', 'company' => 'Gorakshnath Precision Foundry & Industrial Valves', 'type' => 'Manufacturer', 'cat' => 'industrial-machinery',
            'gst' => '09AAACG6633K1Z6', 'address' => 'GIDA Industrial Sector 11',
            'desc' => 'Ductile iron and cast steel industrial valves, pipeline strainers, and heavy mechanical pump impellers for municipal water and thermal plants.',
            'prod' => 'Cast Iron Sluice Valves & Flanged Gate Valves Class 150', 'price' => 4800, 'unit' => 'Piece', 'moq' => 10,
            'pdesc' => 'Non-rising spindle bronze seated cast iron gate valve tested to 21 bar hydro-static pressure for industrial pipelines.',
            'specs' => ['Body' => 'Cast Iron FG 260 / Spheroidal Graphite', 'Flange Standard' => 'BS 10 Table D/E / IS 1538', 'Size' => '50mm to 300mm', 'Seat' => 'Gunmetal / Stainless Steel'],
            'pimg' => 'https://images.unsplash.com/photo-1581092580497-e0d23cbdf1dc?w=600&auto=format&fit=crop&q=80'
        ]
    ],
    [
        'city' => 'Deoria', 'pincode' => '274001', 'image' => 'https://images.unsplash.com/photo-1605007493699-af65834f8a00?w=500&auto=format&fit=crop&q=80',
        's1' => [
            'name' => 'Shyam Sundar Jhunjhunwala', 'company' => 'Deoria Bio-Energy & Refined Sugar Industries', 'type' => 'Manufacturer', 'cat' => 'agriculture-food-processing',
            'gst' => '09AAACD4411M1Z5', 'address' => 'Bhatni Sugar Mill Complex',
            'desc' => 'Producing sulfur-free refined cane sugar, liquid inverted syrups, and sugarcane molasses derived biomass pellets.',
            'prod' => 'S-30 Plantation White Refined Crystal Sugar 50kg Bag', 'price' => 3850, 'unit' => 'Quintal', 'moq' => 100,
            'pdesc' => 'High purity sparkling white crystalline cane sugar with 99.8% sucrose polarization suitable for confectioneries and food processing.',
            'specs' => ['Grade' => 'S-30 / M-30 Indian Sugar', 'ICUMSA' => '< 100 RBU', 'Purity' => '99.8% Sucrose', 'Packaging' => '50 Kg HDPE Bags with Polyliner'],
            'pimg' => 'https://images.unsplash.com/photo-1586201375761-83865001e31c?w=600&auto=format&fit=crop&q=80'
        ],
        's2' => [
            'name' => 'Ramakant Kushwaha', 'company' => 'Deoria Tractor Implements & Rotavators Works', 'type' => 'Manufacturer', 'cat' => 'industrial-machinery',
            'gst' => '09AAACD5522N1Z3', 'address' => 'Industrial Area Salempur Road',
            'desc' => 'Fabricating multi-speed heavy duty rotary tillers, disc ploughs, and tractor mounted seed drills for Indian farming conditions.',
            'prod' => 'Multi-Speed Gearbox 7 Feet Heavy Duty Rotavator', 'price' => 98000, 'unit' => 'Unit', 'moq' => 2,
            'pdesc' => 'Side gear driven 48 L-type boron steel blades rotary tiller with heavy duty PTO shaft and shear bolt protection.',
            'specs' => ['Working Width' => '7 Feet (2.10 Meters)', 'Blades' => '48 Boron Steel L-Type Blades', 'Tractor Power' => '50 - 65 HP', 'Drive' => 'Side Gear Drive in Oil Bath'],
            'pimg' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=600&auto=format&fit=crop&q=80'
        ]
    ],
    [
        'city' => 'Kushinagar', 'pincode' => '274402', 'image' => 'https://images.unsplash.com/photo-1558431382-27e303142255?w=500&auto=format&fit=crop&q=80',
        's1' => [
            'name' => 'Awadhesh Kumar Pandey', 'company' => 'Kushinagar Cold Chain & Agro Exporters', 'type' => 'Exporter', 'cat' => 'agriculture-food-processing',
            'gst' => '09AAACK6611J1Z2', 'address' => 'Kasia Highway Agro Logistics Park',
            'desc' => 'Large scale controlled atmosphere cold storage, grading, sorting, and export packing of fresh vegetables, bananas, and culinary garlic.',
            'prod' => 'Export Grade Fresh Red Onions & Processed Garlic Mash', 'price' => 32, 'unit' => 'Kg', 'moq' => 3000,
            'pdesc' => 'Machine graded 55mm+ diameter fresh red globe onions with dry outer skin and high pungency in ventilated leno mesh bags.',
            'specs' => ['Size' => '55mm - 70mm', 'Color' => 'Deep Ruby Red', 'Moisture' => 'Naturally Cured Dry Skin', 'Packaging' => '25kg / 50kg Leno Mesh Bags'],
            'pimg' => 'https://images.unsplash.com/photo-1586201375761-83865001e31c?w=600&auto=format&fit=crop&q=80'
        ],
        's2' => [
            'name' => 'Dharmendra Gupta', 'company' => 'Buddha Circuit Corrugated Box & Packaging Units', 'type' => 'Manufacturer', 'cat' => 'packaging-materials-containers',
            'gst' => '09AAACB7722K1Z9', 'address' => 'Padrauna Industrial Estate',
            'desc' => 'Automatic 5-ply corrugated cardboard carton manufacturing for industrial food processing, electronics, and e-commerce distribution.',
            'prod' => '5-Ply Heavy Printed Kraft Corrugated Shipping Cartons', 'price' => 34, 'unit' => 'Piece', 'moq' => 1000,
            'pdesc' => '150+ GSM virgin kraft 5-ply carton with double wall B/C flute and 18+ Bursting Factor strength for export cargo handling.',
            'specs' => ['Ply' => '5 Ply Double Wall', 'Bursting Strength' => '18 - 22 kg/cm²', 'Flute' => 'B/C Flute Combination', 'Printing' => 'Flexo 2-Color Printed'],
            'pimg' => 'https://images.unsplash.com/photo-1586201375761-83865001e31c?w=600&auto=format&fit=crop&q=80'
        ]
    ],
    [
        'city' => 'Maharajganj', 'pincode' => '273303', 'image' => 'https://images.unsplash.com/photo-1590496793929-36417d3117de?w=500&auto=format&fit=crop&q=80',
        's1' => [
            'name' => 'Ravi Prakash Kedia', 'company' => 'Maharajganj Timber Seasoning & Commercial Ply Works', 'type' => 'Manufacturer', 'cat' => 'furniture-commercial-office',
            'gst' => '09AAACM8811F1Z1', 'address' => 'Nautanwa Border Road Industrial Complex',
            'desc' => 'Chemical vacuum pressure impregnated hardwood core plywood, commercial blockboards, and flush doors for commercial fit-outs.',
            'prod' => 'BWP Marine Grade Calibrated Plywood 18mm Sheets', 'price' => 88, 'unit' => 'Sq Ft', 'moq' => 100,
            'pdesc' => 'Boiling Water Proof IS 710 certified 18mm marine plywood pressed with synthetic phenol formaldehyde resin and anti-termite treatment.',
            'specs' => ['Standard' => 'IS 710 BWP Grade', 'Thickness' => '18mm (13 Layers)', 'Core' => '100% Eucalyptus Hardwood Core', 'Resistance' => '72 Hours Boiling Water Test Passed'],
            'pimg' => 'https://images.unsplash.com/photo-1538688525198-9b88f6f53126?w=600&auto=format&fit=crop&q=80'
        ],
        's2' => [
            'name' => 'Manish Kumar Srivastava', 'company' => 'Tarai Wire Mesh & Heavy Fencing Solutions', 'type' => 'Manufacturer', 'cat' => 'hardware-sanitaryware-pipes',
            'gst' => '09AAACT9922G1Z8', 'address' => 'Nichlaul Road Industrial Park',
            'desc' => 'Heavy galvanized chain link fencing, anti-cut welded wire mesh panels, and stainless steel insect screening wire.',
            'prod' => 'GI Galvanized Chain Link Boundary Wire Mesh 10 Gauge', 'price' => 85, 'unit' => 'Kg', 'moq' => 500,
            'pdesc' => 'Hot-dip zinc coated 3.15mm (10 SWG) wire diamond pattern chain link mesh for perimeter industrial compound wall security.',
            'specs' => ['Wire Gauge' => '10 Gauge (3.15mm)', 'Mesh Opening' => '50mm x 50mm (2 Inch)', 'Zinc Coating' => '240 GSM Heavy Galvanized', 'Roll Height' => '4, 5, 6, 8 Feet Available'],
            'pimg' => 'https://images.unsplash.com/photo-1504917599217-d4dc5ebe6122?w=600&auto=format&fit=crop&q=80'
        ]
    ],
    [
        'city' => 'Basti', 'pincode' => '272001', 'image' => 'https://images.unsplash.com/photo-1562975871-33230b777a83?w=500&auto=format&fit=crop&q=80',
        's1' => [
            'name' => 'Satish Kumar Singhal', 'company' => 'Basti Kraft Paper & Fluting Board Mills Ltd', 'type' => 'Manufacturer', 'cat' => 'packaging-materials-containers',
            'gst' => '09AAACB1144H1Z6', 'address' => 'Walterganj Industrial Zone',
            'desc' => 'Automated paper machines producing high-bursting factor brown kraft liner reels and semi-chemical fluting medium for packaging converters.',
            'prod' => 'High BF Semi-Kraft Paper Reels 140-200 GSM for Boxes', 'price' => 36, 'unit' => 'Kg', 'moq' => 5000,
            'pdesc' => 'Uniform caliper 18-24 BF kraft paper reel with superior ring crush strength and moisture resistance for corrugation plants.',
            'specs' => ['GSM Range' => '140 to 200 GSM', 'Burst Factor (BF)' => '18 - 24 BF', 'Cobb 60 Value' => '< 35 g/m²', 'Reel Width' => 'Up to 2400 mm'],
            'pimg' => 'https://images.unsplash.com/photo-1586201375761-83865001e31c?w=600&auto=format&fit=crop&q=80'
        ],
        's2' => [
            'name' => 'Hari Om Verma', 'company' => 'Basti Agro Harvester Blades & Forgings', 'type' => 'Manufacturer', 'cat' => 'industrial-machinery',
            'gst' => '09AAACB2255K1Z4', 'address' => 'Harraiya Bypass Industrial Area',
            'desc' => 'Forging and CNC heat treatment of combine harvester cutting sections, straw chopper blades, and threshing rotor teeth.',
            'prod' => 'High Carbon Steel Combine Harvester Straw Blades', 'price' => 95, 'unit' => 'Piece', 'moq' => 200,
            'pdesc' => 'High carbon SAE 1085 forged steel heat treated cutter knife sections with precision serrated edge for clean paddy harvesting.',
            'specs' => ['Material' => 'SAE 1085 Carbon Spring Steel', 'Hardness' => '52 - 56 HRC Induction Hardened', 'Edge' => 'Precision Under-Serrated', 'Finish' => 'Anti-Rust Blackened Zinc'],
            'pimg' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=600&auto=format&fit=crop&q=80'
        ]
    ],
    [
        'city' => 'Sant Kabir Nagar', 'pincode' => '272175', 'image' => 'https://images.unsplash.com/photo-1587474260584-136574528ed5?w=500&auto=format&fit=crop&q=80',
        's1' => [
            'name' => 'Abdul Wahid Ansari', 'company' => 'Khalilabad Cotton Fabrics & Hosiery Mills', 'type' => 'Manufacturer', 'cat' => 'textiles-fabrics-workwear',
            'gst' => '09AAACK3311P1Z7', 'address' => 'Khalilabad Handloom Industrial Cluster',
            'desc' => 'High volume production of cotton lungis, grey woven sheeting, hosiery knitted fabrics, and industrial protective garments.',
            'prod' => 'Knitted Single Jersey Cotton T-Shirt Fabric 180 GSM', 'price' => 290, 'unit' => 'Kg', 'moq' => 250,
            'pdesc' => 'Bio-washed 100% combed cotton circular knitted single jersey roll fabric in reactive dyed solid corporate colors.',
            'specs' => ['GSM' => '180 GSM (± 5%)', 'Yarn' => '30s Combed Compact Cotton', 'Width' => '72 Inch Open Width', 'Dyeing' => 'Color Fastness 4.5+ Reactive Dyed'],
            'pimg' => 'https://images.unsplash.com/photo-1617627143750-d86bc21e42bb?w=600&auto=format&fit=crop&q=80'
        ],
        's2' => [
            'name' => 'Pradeep Kumar Kasera', 'company' => 'Sant Kabir Brass & Aluminum Utensil Casting Works', 'type' => 'Manufacturer', 'cat' => 'hardware-sanitaryware-pipes',
            'gst' => '09AAACS4422Q1Z5', 'address' => 'Bakhira Metal Craft Zone',
            'desc' => 'Sand cast and hydraulic pressed heavy commercial brass and food-grade aluminum cooking cauldrons, kadhais, and catering equipment.',
            'prod' => 'Commercial Heavy Die-Cast Aluminum Cauldron & Utensils', 'price' => 275, 'unit' => 'Kg', 'moq' => 100,
            'pdesc' => 'Pure 99.5% virgin aluminium 5mm thickness commercial heavy bottom cauldron with welded lifting handles for institutional catering.',
            'specs' => ['Capacity' => '50 to 200 Liters', 'Wall Thickness' => '5.0mm Heavy Bottom', 'Grade' => 'Food Grade 1050 Virgin Aluminum', 'Handles' => 'Double Riveted Solid Aluminium'],
            'pimg' => 'https://images.unsplash.com/photo-1581092580497-e0d23cbdf1dc?w=600&auto=format&fit=crop&q=80'
        ]
    ],
    [
        'city' => 'Siddharthnagar', 'pincode' => '272207', 'image' => 'https://images.unsplash.com/photo-1570168007204-dfb528c6958f?w=500&auto=format&fit=crop&q=80',
        's1' => [
            'name' => 'Chandra Shekhar Singh', 'company' => 'Siddharthnagar Organic Kalanamak Rice Exports', 'type' => 'Exporter', 'cat' => 'agriculture-food-processing',
            'gst' => '09AAACS5511L1Z0', 'address' => 'Naugarh Agro Export Complex',
            'desc' => 'Geographical Indication (GI) certified farmers consortium exporting authentic aromatic Lord Buddha Kalanamak black-husk scented rice.',
            'prod' => 'GI Tagged Heritage Aromatic Kalanamak Buddha Rice', 'price' => 140, 'unit' => 'Kg', 'moq' => 500,
            'pdesc' => 'World-famous black husked micro-nutrient rich aroma rice with low glycemic index and high iron & zinc content.',
            'specs' => ['Certification' => 'GI Certified Authenticity', 'Aroma Score' => '4.8/5.0 Strong Pandan Aroma', 'Purity' => '100% Pure Kalanamak', 'Packaging' => '5kg / 10kg Vacuum Foil Packs'],
            'pimg' => 'https://images.unsplash.com/photo-1586201375761-83865001e31c?w=600&auto=format&fit=crop&q=80'
        ],
        's2' => [
            'name' => 'Om Prakash Maurya', 'company' => 'Kapilvastu Agri Spares & Tillage Tools', 'type' => 'Manufacturer', 'cat' => 'industrial-machinery',
            'gst' => '09AAACK6622M1Z8', 'address' => 'Shohratgarh Bypass Industrial Road',
            'desc' => 'Manufacturing spring loaded tractor tillers, subsoilers, and heavy duty reversible MB ploughs for hard alluvial soils.',
            'prod' => '9-Tyne Rigid Cultivator Shovels & Spring Loaded Tillers', 'price' => 28500, 'unit' => 'Unit', 'moq' => 5,
            'pdesc' => 'Heavy duty 65x65mm square hollow section frame cultivator with forged spring steel reversible shovels.',
            'specs' => ['Number of Tynes' => '9 Tynes Spring Loaded', 'Frame' => 'Heavy 65mm Square Tubular Box', 'Shovel Material' => 'EN45 Spring Steel Forged', 'Tractor Power' => '35 - 45 HP'],
            'pimg' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=600&auto=format&fit=crop&q=80'
        ]
    ],
    [
        'city' => 'Mirzapur', 'pincode' => '231001', 'image' => 'https://images.unsplash.com/photo-1582510003544-4d00b7f74220?w=500&auto=format&fit=crop&q=80',
        's1' => [
            'name' => 'Santosh Kumar Bind', 'company' => 'Vindhya Natural Stone & Slate Tiles Consortium', 'type' => 'Manufacturer', 'cat' => 'construction-steel-piping',
            'gst' => '09AAACV7711B1Z3', 'address' => 'Chunar Mining & Industrial Cluster',
            'desc' => 'Quarrying, gangsaw slicing, and calibration of Chunar buff sandstone, red sandstone tiles, and heavy stone cladding slabs.',
            'prod' => 'Chunar Natural Sandstone Slabs & Paving Cobbles', 'price' => 65, 'unit' => 'Sq Ft', 'moq' => 500,
            'pdesc' => 'Natural hand-cleft and sawn finish hard sandstone slabs with high compressive load capacity for walkways and exterior cladding.',
            'specs' => ['Thickness' => '25mm / 35mm / 50mm Calibrated', 'Finish' => 'Natural Cleft / Flamed / Honed', 'Compressive Strength' => '1100 kg/cm²', 'Water Absorption' => '< 1.2%'],
            'pimg' => 'https://images.unsplash.com/photo-1504917599217-d4dc5ebe6122?w=600&auto=format&fit=crop&q=80'
        ],
        's2' => [
            'name' => 'Vipin Bihari Baranwal', 'company' => 'Mirzapur Heritage Hand-Knotted Woolen Carpets', 'type' => 'Manufacturer', 'cat' => 'textiles-fabrics-workwear',
            'gst' => '09AAACM8822C1Z1', 'address' => 'Kachhawa Road Carpet Weaving Park',
            'desc' => 'Master weavers crafting traditional hand-knotted and flat woven dhurrie carpets with 100% indigenous and New Zealand blended wool.',
            'prod' => 'Hand Knotted Persian Design New Zealand Wool Carpets', 'price' => 550, 'unit' => 'Sq Ft', 'moq' => 100,
            'pdesc' => 'Exquisite 9x9 (81 knots per sq inch) hand knotted carpet using semi-worsted wool on pure cotton warp in classic oriental motifs.',
            'specs' => ['Knot Density' => '81 Knots / Sq Inch', 'Pile Material' => '80% NZ Wool + 20% Indian Wool', 'Pile Height' => '10mm - 12mm', 'Dyeing' => 'Chrome Pot Dyed Wash-Fast'],
            'pimg' => 'https://images.unsplash.com/photo-1617627143750-d86bc21e42bb?w=600&auto=format&fit=crop&q=80'
        ]
    ],
    [
        'city' => 'Sonbhadra', 'pincode' => '231216', 'image' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=500&auto=format&fit=crop&q=80',
        's1' => [
            'name' => 'Satyendra Kumar Pandey', 'company' => 'Sonbhadra Heavy Mining Machinery & Excavator Spares', 'type' => 'Manufacturer', 'cat' => 'industrial-machinery',
            'gst' => '09AAACS9911X1Z6', 'address' => 'Anpara-Renukoot Heavy Industrial Belt',
            'desc' => 'Manufacturing heavy wear-resistant alloy castings, dragline bucket teeth, crusher jaw plates, and conveyor idler rollers for opencast coal mines.',
            'prod' => 'Forged Hardened Excavator Bucket Teeth & Adapters', 'price' => 1450, 'unit' => 'Piece', 'moq' => 20,
            'pdesc' => 'High manganese austempered ductile alloy steel point adapters and rock chisel teeth resistant to high impact and abrasive wear.',
            'specs' => ['Material' => 'High Manganese Low Alloy Steel', 'Hardness' => '480 - 530 BHN Core Hardened', 'Compatibility' => 'CAT / Komatsu / Tata Hitachi 20-45T', 'Fastener' => 'Heavy Lock Pin Included'],
            'pimg' => 'https://images.unsplash.com/photo-1581092580497-e0d23cbdf1dc?w=600&auto=format&fit=crop&q=80'
        ],
        's2' => [
            'name' => 'Deepak Jha', 'company' => 'Rihand High Tension Conductors & Power Cables', 'type' => 'Manufacturer', 'cat' => 'electrical-electronics-cables',
            'gst' => '09AAACR1122Y1Z4', 'address' => 'Robertsganj Industrial Area',
            'desc' => 'Stranding of overhead electrical transmission conductors (ACSR/AAAC) and extra high voltage aerial bundled conductors for electricity boards.',
            'prod' => 'ACSR Zebra & Panther Overhead Transmission Conductors', 'price' => 185, 'unit' => 'Meter', 'moq' => 1000,
            'pdesc' => 'Aluminium Conductor Steel Reinforced (ACSR) multi-wire stranded heavy transmission line conductor conforming to IS 398 Part 2.',
            'specs' => ['Code Name' => 'ACSR Panther / Zebra', 'Stranding' => '30/3.00mm Al + 7/3.00mm Steel', 'Current Rating' => '480 Amperes Continuous', 'Standard' => 'IS 398 (Part 2) : 1996'],
            'pimg' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=600&auto=format&fit=crop&q=80'
        ]
    ],
    [
        'city' => 'Bhadohi', 'pincode' => '221401', 'image' => 'https://images.unsplash.com/photo-1558431382-27e303142255?w=500&auto=format&fit=crop&q=80',
        's1' => [
            'name' => 'Zubair Ahmad Ansari', 'company' => 'Bhadohi Oriental Tufted Rugs & Export Carpets', 'type' => 'Exporter', 'cat' => 'textiles-fabrics-workwear',
            'gst' => '09AAACB2211T1Z7', 'address' => 'Carpet City Industrial Park Phase 1',
            'desc' => 'India largest carpet weaving cluster exporter specializing in robot tufted and hand-tufted modern rugs for global home decor brands.',
            'prod' => 'Hand Tufted Modern Geometric Wool Area Rugs 8x10 Ft', 'price' => 12500, 'unit' => 'Piece', 'moq' => 10,
            'pdesc' => 'High density hand tufted pure wool area rug with heavy cotton cloth backing and double latex adhesive for non-slip floor placement.',
            'specs' => ['Dimensions' => '8 x 10 Feet (240 x 300 cm)', 'Yarn' => '100% Indian Bikaner & NZ Wool', 'Backing' => 'Action Bac with Eco Latex', 'Weight' => '3.8 kg/m²'],
            'pimg' => 'https://images.unsplash.com/photo-1617627143750-d86bc21e42bb?w=600&auto=format&fit=crop&q=80'
        ],
        's2' => [
            'name' => 'Ghanshyam Das Maurya', 'company' => 'Eastern UP Floor Coverings & Wool Spun Fibres', 'type' => 'Manufacturer', 'cat' => 'textiles-fabrics-workwear',
            'gst' => '09AAACE3322U1Z5', 'address' => 'Gyanpur Road Textile Industrial Area',
            'desc' => 'Wool blending, carding, and semi-worsted spinning mills producing natural undyed and dyed yarn for carpet and knitwear manufacturers.',
            'prod' => 'Semi-Worsted Carpet Weaving Wool Yarn Hanks 60 Nm', 'price' => 480, 'unit' => 'Kg', 'moq' => 200,
            'pdesc' => 'Scoured and semi-worsted 2/60 Nm carpet yarn hanks with high tensile strength and minimal shedding properties.',
            'specs' => ['Count' => '2/60 Nm Metric Count', 'Blend' => '70% Wool + 30% Nylon', 'Form' => 'Cross Wound 1.5kg Hanks', 'Strength' => 'High Tenacity Twist (6.8 cN/tex)'],
            'pimg' => 'https://images.unsplash.com/photo-1617627143750-d86bc21e42bb?w=600&auto=format&fit=crop&q=80'
        ]
    ],
    [
        'city' => 'Ayodhya', 'pincode' => '224001', 'image' => 'https://images.unsplash.com/photo-1605007493699-af65834f8a00?w=500&auto=format&fit=crop&q=80',
        's1' => [
            'name' => 'Prashant Kumar Mishra', 'company' => 'Ayodhya Solar Infra & Rooftop Systems Ltd', 'type' => 'Manufacturer', 'cat' => 'solar-renewable-energy',
            'gst' => '09AAACA4411S1Z2', 'address' => 'Faizabad-Ayodhya Industrial Zone',
            'desc' => 'Developing utility scale solar plants, solar street lighting projects, and rooftop on-grid net metering inverter systems.',
            'prod' => 'Complete 10 kW Commercial On-Grid Solar Inverter & Array', 'price' => 420000, 'unit' => 'System', 'moq' => 1,
            'pdesc' => 'Complete turn-key 10kW 3-Phase on-grid solar system with 550W bifacial solar panels, high efficiency MPPT inverter and aluminum mounting structures.',
            'specs' => ['System Capacity' => '10 kW (Three Phase 415V)', 'Inverter' => 'Growatt/Sungrow 10kW Dual MPPT', 'Generation' => '40 - 45 Units / Day Average', 'Warranty' => '25 Years Performance'],
            'pimg' => 'https://images.unsplash.com/photo-1509391365360-2e959784a276?w=600&auto=format&fit=crop&q=80'
        ],
        's2' => [
            'name' => 'Ram Sevak Soni', 'company' => 'Ram Janmabhoomi Brassware & Architectural Hardware', 'type' => 'Manufacturer', 'cat' => 'hardware-sanitaryware-pipes',
            'gst' => '09AAACR5522T1Z0', 'address' => 'Mani Parbat Road Hardware Cluster',
            'desc' => 'Heavy artistic sand cast brass temple bells, monumental main entrance door handles, and classical architectural brass hardware.',
            'prod' => 'Traditional Cast Brass Main Door Handles & Mortise Locks', 'price' => 850, 'unit' => 'Set', 'moq' => 50,
            'pdesc' => 'Heavy solid cast brass 12-inch main entrance door pull handles finished in antique brass lacquer with high security 6-lever mortise lock body.',
            'specs' => ['Length' => '12 Inches (300mm)', 'Material' => 'Heavy Solid Cast Brass', 'Finish' => 'Antique Brush Copper Lacquer', 'Package' => 'Pair Handles + Lock Body + 3 Computerized Keys'],
            'pimg' => 'https://images.unsplash.com/photo-1581092580497-e0d23cbdf1dc?w=600&auto=format&fit=crop&q=80'
        ]
    ],
    [
        'city' => 'Ambedkar Nagar', 'pincode' => '224122', 'image' => 'https://images.unsplash.com/photo-1596176530529-78163a4f7af2?w=500&auto=format&fit=crop&q=80',
        's1' => [
            'name' => 'Mohd Sirajuddin', 'company' => 'Tanda Powerloom Cotton & Polyester Cloth Mills', 'type' => 'Manufacturer', 'cat' => 'textiles-fabrics-workwear',
            'gst' => '09AAACT6611K1Z3', 'address' => 'Tanda Textile Hub Phase 2',
            'desc' => 'High speed shuttleless looms producing uniform fabrics, poly-viscose suitings, healthcare medical scrub fabrics, and yarn dyed plaids.',
            'prod' => 'Bleached Cotton Poplin Uniform Fabric 58 Inch Width', 'price' => 68, 'unit' => 'Meter', 'moq' => 500,
            'pdesc' => 'Mercerized 100% fine cotton poplin fabric with high tear strength and anti-pilling resin finish for institutional uniforms.',
            'specs' => ['Width' => '58 Inches (147 cm)', 'Weave' => 'Plain 1/1 Poplin Weave', 'Thread Count' => '133 x 72 (40s x 40s)', 'Finish' => 'Fully Mercerized Bleached White'],
            'pimg' => 'https://images.unsplash.com/photo-1617627143750-d86bc21e42bb?w=600&auto=format&fit=crop&q=80'
        ],
        's2' => [
            'name' => 'Rajeshwar Pratap Singh', 'company' => 'Ambedkar Nagar Structural Steel & Truss Works', 'type' => 'Manufacturer', 'cat' => 'construction-steel-piping',
            'gst' => '09AAACA7722L1Z1', 'address' => 'Akbarpur Industrial Area',
            'desc' => 'Pre-Engineered Building (PEB) design, cold formed Z/C purlins, steel roof trusses, and heavy industrial warehouse frameworks.',
            'prod' => 'Pre-Engineered Building (PEB) Structural Steel Trusses', 'price' => 62000, 'unit' => 'Ton', 'moq' => 5,
            'pdesc' => 'Custom fabricated high tensile IS 2062 Grade E250/E350 structural steel PEB portal frames and built-up welded rafters.',
            'specs' => ['Steel Grade' => 'IS 2062 E350BR / ASTM A572', 'Clear Span' => '15 to 45 Meters Column-Free', 'Welding' => 'Submerged Arc Welded (SAW)', 'Painting' => 'Epoxy Zinc Phosphate Primer 80 Microns'],
            'pimg' => 'https://images.unsplash.com/photo-1504917599217-d4dc5ebe6122?w=600&auto=format&fit=crop&q=80'
        ]
    ],
    [
        'city' => 'Sultanpur', 'pincode' => '228001', 'image' => 'https://images.unsplash.com/photo-1561361513-2d000a50f0dc?w=500&auto=format&fit=crop&q=80',
        's1' => [
            'name' => 'Devendra Pratap Singh', 'company' => 'Sultanpur Electrical Transformers & Switchgears', 'type' => 'Manufacturer', 'cat' => 'electrical-electronics-cables',
            'gst' => '09AAACS8811V1Z5', 'address' => 'Amethi-Sultanpur Industrial Corridor',
            'desc' => 'BIS certified distribution and power transformer manufacturing ranging from 25 kVA up to 5000 kVA for rural and industrial electrification.',
            'prod' => '100 kVA 11kV/415V Three Phase Oil Cooled Distribution Transformer', 'price' => 165000, 'unit' => 'Unit', 'moq' => 1,
            'pdesc' => 'Energy efficient Level-2 (BEE Star Rated) copper wound 100 kVA transformer with CRGO core laminations and mineral oil cooling.',
            'specs' => ['Rating' => '100 kVA', 'Voltage Ratio' => '11000 Volts / 433 Volts', 'Winding' => '100% Electrolytic High Conductivity Copper', 'Efficiency' => 'BEE Star Level 2 Loss Compliant'],
            'pimg' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=600&auto=format&fit=crop&q=80'
        ],
        's2' => [
            'name' => 'Shailesh Kumar Tiwari', 'company' => 'Sultanpur Hybrid Seeds & Agricultural Bio-Nutrients', 'type' => 'Manufacturer', 'cat' => 'chemicals-polymers-plastics',
            'gst' => '09AAACS9922W1Z3', 'address' => 'Kurwar Road Agro Tech Hub',
            'desc' => 'Formulating liquid bio-fertilizers, mycorrhizal root promoters, seaweed bio-stimulants, and certified hybrid cereal seed varieties.',
            'prod' => 'Liquid Bio-NPK Microbial Fertilizer & Soil Conditioners', 'price' => 320, 'unit' => 'Liter', 'moq' => 100,
            'pdesc' => 'Consortium of nitrogen fixing Azotobacter, phosphate solubilizing PSB, and potassium mobilizing KMB bacteria in stabilized liquid carrier.',
            'specs' => ['Viable Count' => '1 x 10^8 CFU/ml Minimum', 'pH Range' => '6.5 - 7.5', 'Dosage' => '1 Liter / Acre via Drip or Spray', 'Shelf Life' => '18 Months in Sealed Pack'],
            'pimg' => 'https://images.unsplash.com/photo-1535585209827-a15fcdbc4c2d?w=600&auto=format&fit=crop&q=80'
        ]
    ],
    [
        'city' => 'Pratapgarh', 'pincode' => '230001', 'image' => 'https://images.unsplash.com/photo-1570168007204-dfb528c6958f?w=500&auto=format&fit=crop&q=80',
        's1' => [
            'name' => 'Abhay Kumar Pandey', 'company' => 'Pratapgarh Amla Processing & Herbal Health Extracts', 'type' => 'Manufacturer', 'cat' => 'medical-pharma-healthcare',
            'gst' => '09AAACP1155M1Z8', 'address' => 'Amla Processing Cluster Bela Industrial Zone',
            'desc' => 'India largest amla hub manufacturer of cold pressed organic Indian gooseberry juice, amla murabba, dry candy, and standardized Vitamin C extracts.',
            'prod' => 'Pure Organic Amla Juice Extract & Powder 50kg Drum', 'price' => 180, 'unit' => 'Kg', 'moq' => 200,
            'pdesc' => 'Direct expeller pressed and spray-dried Emblica officinalis whole fruit extract standardized to 30% natural tannins and ascorbic acid.',
            'specs' => ['Grade' => 'Pharma / Food Supplement Grade', 'Standardization' => 'Min 30% Tannins / Natural Vitamin C', 'Form' => 'Fine Spray Dried 80 Mesh Powder', 'Purity' => '100% Herbal No Additives'],
            'pimg' => 'https://images.unsplash.com/photo-1586201375761-83865001e31c?w=600&auto=format&fit=crop&q=80'
        ],
        's2' => [
            'name' => 'Rameshwar Nath Shukla', 'company' => 'Pratapgarh Spun Concrete Poles & Drainage Pipes', 'type' => 'Manufacturer', 'cat' => 'construction-steel-piping',
            'gst' => '09AAACP2266N1Z6', 'address' => 'Kunda Highway Industrial Area',
            'desc' => 'Pre-stressed spun concrete electrical transmission poles, RCC Hume pipes, and heavy precast concrete boundary wall panels.',
            'prod' => 'RCC Spun Reinforced Concrete Drainage Pipes Class NP3', 'price' => 1850, 'unit' => 'Meter', 'moq' => 50,
            'pdesc' => 'Centrifugally cast heavy reinforced concrete pipes with socket & spigot joint conforming to IS 458 Class NP3 for culverts and storm drains.',
            'specs' => ['Diameter' => '300mm to 1200mm Nominal Bore', 'Class' => 'IS 458 Class NP3 (Medium Traffic)', 'Concrete Grade' => 'M-35 Centrifugally Compacted', 'Length' => '2.5 Meters per Spigot Pipe'],
            'pimg' => 'https://images.unsplash.com/photo-1504917599217-d4dc5ebe6122?w=600&auto=format&fit=crop&q=80'
        ]
    ],
    [
        'city' => 'Gonda', 'pincode' => '271001', 'image' => 'https://images.unsplash.com/photo-1587474260584-136574528ed5?w=500&auto=format&fit=crop&q=80',
        's1' => [
            'name' => 'Virendra Kumar Singh', 'company' => 'Gonda Precision Farm Implements & Tillage Blades', 'type' => 'Manufacturer', 'cat' => 'industrial-machinery',
            'gst' => '09AAACG3311Z1Z7', 'address' => 'Karnailganj Road Industrial Area',
            'desc' => 'Manufacturing tractor trailing hydraulic disc harrows, laser land levelers, and forged spring steel rotavator blades.',
            'prod' => 'Heavy Disc Harrow 16-Disc Hydraulic Trailing Type', 'price' => 74000, 'unit' => 'Unit', 'moq' => 2,
            'pdesc' => 'Heavy duty 16 notched high-carbon boron steel discs mounted on sealed double ball bearing spools with hydraulic transport wheels.',
            'specs' => ['Number of Discs' => '16 Discs (8 Front Notched + 8 Rear Plain)', 'Disc Diameter' => '22 Inch (560mm) Boron Steel', 'Working Width' => '1.95 Meters', 'Tractor Power' => '45 - 55 HP'],
            'pimg' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=600&auto=format&fit=crop&q=80'
        ],
        's2' => [
            'name' => 'Pradeep Kumar Agrawal', 'company' => 'Devipatan Roller Flour & Industrial Grain Mills', 'type' => 'Manufacturer', 'cat' => 'agriculture-food-processing',
            'gst' => '09AAACD4422A1Z5', 'address' => 'Industrial Area Balrampur Road',
            'desc' => 'Swiss Bühler automated roller flour mill producing premium bakery maida, whole wheat chakki atta, and semolina suji.',
            'prod' => 'Industrial Grade Bakery Maida & Semolina 50kg Bags', 'price' => 1650, 'unit' => 'Bag', 'moq' => 100,
            'pdesc' => 'High gluten 100% pure refined wheat flour tailored for automatic biscuit, bread, and noodle continuous industrial lines.',
            'specs' => ['Moisture' => '< 13.0%', 'Dry Gluten' => '> 10.5%', 'Ash Content' => '< 0.50%', 'Packaging' => '50 Kg HDPE Laminated Bags'],
            'pimg' => 'https://images.unsplash.com/photo-1586201375761-83865001e31c?w=600&auto=format&fit=crop&q=80'
        ]
    ],
    [
        'city' => 'Bahraich', 'pincode' => '271801', 'image' => 'https://images.unsplash.com/photo-1606820245089-b1d5c5896a2f?w=500&auto=format&fit=crop&q=80',
        's1' => [
            'name' => 'Nawazish Ali Khan', 'company' => 'Bahraich Commercial Plywood & Timber Works', 'type' => 'Manufacturer', 'cat' => 'furniture-commercial-office',
            'gst' => '09AAACB5511D1Z9', 'address' => 'Nanpara Highway Industrial Complex',
            'desc' => 'High quality commercial plywood, flush door cores, and timber seasoning plants utilizing sustainable plantation timber.',
            'prod' => 'Commercial MR Grade Hardwood Core Plywood 12mm', 'price' => 64, 'unit' => 'Sq Ft', 'moq' => 150,
            'pdesc' => 'Moisture Resistant IS 303 certified 12mm plywood bonded with high quality melamine urea formaldehyde resin for indoor furniture.',
            'specs' => ['Standard' => 'IS 303 MR Grade', 'Thickness' => '12mm (9 Layers)', 'Face Veneer' => 'Gurjan / Okoume 0.3mm Face', 'Adhesive' => 'Melamine Fortified Resin'],
            'pimg' => 'https://images.unsplash.com/photo-1538688525198-9b88f6f53126?w=600&auto=format&fit=crop&q=80'
        ],
        's2' => [
            'name' => 'Kamleshwar Prasad Maurya', 'company' => 'Bahraich Natural Mentha & Essential Oil Distilleries', 'type' => 'Manufacturer', 'cat' => 'chemicals-polymers-plastics',
            'gst' => '09AAACB6622E1Z7', 'address' => 'Risia Industrial Area',
            'desc' => 'Large scale fractional distillation of Mentha arvensis crude oil yielding pure L-menthol crystals, de-mentholized peppermint oil, and piperita extracts.',
            'prod' => 'Pure Mentha Arvensis Peppermint Oil Crystal 99% BP', 'price' => 1250, 'unit' => 'Kg', 'moq' => 50,
            'pdesc' => 'Natural pure crystalline L-menthol USP/BP grade derived from Mentha arvensis leaves for pharma, confectioneries, and dental care.',
            'specs' => ['Purity (L-Menthol)' => '> 99.2%', 'Melting Point' => '42°C - 44°C', 'Form' => 'Clear Needle Shaped Crystals', 'Standard' => 'IP / BP / USP Pharma Grade'],
            'pimg' => 'https://images.unsplash.com/photo-1535585209827-a15fcdbc4c2d?w=600&auto=format&fit=crop&q=80'
        ]
    ],
    [
        'city' => 'Shravasti', 'pincode' => '271831', 'image' => 'https://images.unsplash.com/photo-1582510003544-4d00b7f74220?w=500&auto=format&fit=crop&q=80',
        's1' => [
            'name' => 'Bhanu Pratap Singh', 'company' => 'Shravasti Modern Rice Mill & Silo Processing', 'type' => 'Manufacturer', 'cat' => 'agriculture-food-processing',
            'gst' => '09AAACS7711G1Z4', 'address' => 'Ikauna Bypass Agro Complex',
            'desc' => 'Automated paddy parboiling, drying silos, and precision multi-stage optical sorter milling producing long grain parboiled rice.',
            'prod' => 'Premium Long Grain Parboiled Rice Silo Cleaned', 'price' => 42, 'unit' => 'Kg', 'moq' => 5000,
            'pdesc' => 'Golden parboiled long grain rice with zero chalky grains, high gelatinization, and rich in natural B-complex vitamins.',
            'specs' => ['Grain Length' => '6.2mm Average', 'Broken Ratio' => '< 3.0%', 'Sortex' => '100% Optical Double Sortex Clean', 'Packaging' => '50 Kg Export Woven Bags'],
            'pimg' => 'https://images.unsplash.com/photo-1586201375761-83865001e31c?w=600&auto=format&fit=crop&q=80'
        ],
        's2' => [
            'name' => 'Lal Bahadur Verma', 'company' => 'Shravasti Fly Ash Bricks & Concrete Block Plant', 'type' => 'Manufacturer', 'cat' => 'construction-steel-piping',
            'gst' => '09AAACS8822H1Z2', 'address' => 'Bhinga Industrial Area',
            'desc' => 'High pressure hydraulic pressing of eco-friendly fly ash building bricks, interlocking paver blocks, and solid concrete masonry units.',
            'prod' => 'High Strength Hydraulic Compressed Fly Ash Bricks', 'price' => 6.5, 'unit' => 'Piece', 'moq' => 5000,
            'pdesc' => 'High density uniform dimension fly ash bricks manufactured with cement, lime, and stone dust for cost-effective structural walling.',
            'specs' => ['Dimensions' => '230 x 110 x 75 mm (Standard Modular)', 'Compressive Strength' => '> 10.5 N/mm² (Class 10)', 'Water Absorption' => '< 12%', 'Thermal Conductivity' => '0.35 W/mK'],
            'pimg' => 'https://images.unsplash.com/photo-1504917599217-d4dc5ebe6122?w=600&auto=format&fit=crop&q=80'
        ]
    ],
    [
        'city' => 'Balrampur', 'pincode' => '271201', 'image' => 'https://images.unsplash.com/photo-1599661046289-e31897846e41?w=500&auto=format&fit=crop&q=80',
        's1' => [
            'name' => 'Vivek Kumar Saraogi', 'company' => 'Balrampur Bio-Energy & Industrial Refinery Ltd', 'type' => 'Manufacturer', 'cat' => 'chemicals-polymers-plastics',
            'gst' => '09AAACB9911K1Z8', 'address' => 'Balrampur Industrial Complex Sector 4',
            'desc' => 'Asia largest integrated cane processing complex manufacturing fuel grade anhydrous ethanol, refined industrial alcohol, and potash organic manure.',
            'prod' => 'Anhydrous Ethanol Fuel Grade 99.5% for Industrial Blends', 'price' => 62, 'unit' => 'Liter', 'moq' => 10000,
            'pdesc' => 'Anhydrous ethanol 99.5% v/v purity manufactured using molecular sieve dehydration technology for petroleum blending and chemical synthesis.',
            'specs' => ['Purity (Ethanol)' => '> 99.5% by Volume', 'Moisture' => '< 0.20%', 'Density at 20°C' => '0.7915 g/ml', 'Packaging' => 'Bulk Road Tankers / ISO Tank Containers'],
            'pimg' => 'https://images.unsplash.com/photo-1535585209827-a15fcdbc4c2d?w=600&auto=format&fit=crop&q=80'
        ],
        's2' => [
            'name' => 'Suresh Kumar Agrahari', 'company' => 'Balrampur Heavy Barbed Wire & Chainlink Works', 'type' => 'Manufacturer', 'cat' => 'hardware-sanitaryware-pipes',
            'gst' => '09AAACB1122L1Z6', 'address' => 'Tulsipur Road Industrial Zone',
            'desc' => 'High tensile galvanized double strand barbed security wire, welded wire fabric, and razor blade concertina coils for border security.',
            'prod' => 'High Tensile Galvanized Barbed Security Fencing Wire', 'price' => 78, 'unit' => 'Kg', 'moq' => 500,
            'pdesc' => 'Double strand 12x14 SWG hot-dipped zinc galvanized steel wire with sharp 4-point barbs at 3-inch spacing for perimeter defense.',
            'specs' => ['Main Strand' => '12 SWG (2.5mm) Double Strand', 'Barb Wire' => '14 SWG 4-Point Barbs', 'Barb Spacing' => '75mm (3 Inches)', 'Zinc Coating' => '180 GSM Heavy Zinc Coating'],
            'pimg' => 'https://images.unsplash.com/photo-1504917599217-d4dc5ebe6122?w=600&auto=format&fit=crop&q=80'
        ]
    ]
];

echo "Beginning seeding for " . count($upCitiesList) . " Uttar Pradesh Industrial Cities...\n";

$seededCount = 0;
$productsCount = 0;

foreach ($upCitiesList as $cityData) {
    // 1. Ensure location exists
    $location = Location::updateOrCreate(
        ['city' => $cityData['city']],
        [
            'state' => 'Uttar Pradesh',
            'country' => 'India',
            'pincode' => $cityData['pincode'],
            'is_popular' => true,
            'image' => $cityData['image'],
        ]
    );

    // 2. Seed Supplier 1 and Supplier 2
    foreach (['s1', 's2'] as $sKey) {
        $sInfo = $cityData[$sKey];
        $slug = Str::slug($sInfo['company']);
        $email = 'supplier_' . Str::slug($cityData['city'], '_') . '_' . $sKey . '@ozura.com';
        $mobile = '+91 95' . rand(10000000, 99999999);

        // Find or create User
        $user = User::updateOrCreate(
            ['email' => $email],
            [
                'name' => $sInfo['name'],
                'mobile' => $mobile,
                'role' => 'supplier',
                'status' => 'active',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'mobile_verified_at' => now(),
            ]
        );

        // Find or create Supplier
        $supplier = Supplier::updateOrCreate(
            ['user_id' => $user->id],
            [
                'subscription_plan_id' => $premiumPlan->id,
                'company_name' => $sInfo['company'],
                'slug' => $slug,
                'business_type' => $sInfo['type'],
                'year_established' => rand(2005, 2018),
                'employees_count' => '50-100 People',
                'gst_number' => $sInfo['gst'],
                'pan_number' => substr($sInfo['gst'], 2, 10),
                'city' => $cityData['city'],
                'state' => 'Uttar Pradesh',
                'country' => 'India',
                'pincode' => $cityData['pincode'],
                'address' => $sInfo['address'],
                'logo' => 'https://images.unsplash.com/photo-1560179707-f14e90ef3623?w=200&auto=format&fit=crop&q=80',
                'banner' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=1200&auto=format&fit=crop&q=80',
                'description' => $sInfo['desc'],
                'website' => 'https://www.' . $slug . '.ozura.in',
                'is_verified' => true,
                'verification_level' => 'GST',
                'rating_avg' => round(4.5 + (rand(1, 45) / 100), 2),
                'reviews_count' => rand(15, 60),
                'views_count' => rand(800, 2500),
                'is_featured' => true,
                'status' => 'active',
            ]
        );

        // Create active subscription
        Subscription::updateOrCreate(
            ['supplier_id' => $supplier->id],
            [
                'plan_id' => $premiumPlan->id,
                'starts_at' => now()->subMonths(2),
                'ends_at' => now()->addMonths(10),
                'status' => 'active',
                'payment_id' => 'pay_up_' . Str::random(8),
            ]
        );

        // Create GST verification document
        SupplierDocument::updateOrCreate(
            ['supplier_id' => $supplier->id, 'doc_type' => 'GST_Certificate'],
            [
                'doc_number' => $sInfo['gst'],
                'file_path' => 'documents/verified_gst_' . $supplier->id . '.pdf',
                'status' => 'approved',
                'verified_at' => now()->subMonths(2),
            ]
        );

        // Find Category
        $cat = Category::where('slug', $sInfo['cat'])->first() ?? Category::first();
        $subcat = $cat ? $cat->subcategories()->first() : null;

        // Create Product
        $pSlug = Str::slug($sInfo['prod'] . '-' . $supplier->city);
        $product = Product::updateOrCreate(
            ['slug' => $pSlug],
            [
                'supplier_id' => $supplier->id,
                'category_id' => $cat ? $cat->id : 1,
                'subcategory_id' => $subcat ? $subcat->id : null,
                'name' => $sInfo['prod'],
                'description' => $sInfo['pdesc'],
                'price' => $sInfo['price'],
                'currency' => 'INR',
                'unit' => $sInfo['unit'],
                'moq' => $sInfo['moq'],
                'specifications' => $sInfo['specs'],
                'is_featured' => true,
                'is_active' => true,
                'rating_avg' => round(4.6 + (rand(1, 35) / 100), 2),
                'reviews_count' => rand(8, 30),
                'views_count' => rand(400, 1500),
            ]
        );

        // Add Product Image
        ProductImage::updateOrCreate(
            ['product_id' => $product->id, 'is_primary' => true],
            [
                'image_path' => $sInfo['pimg'],
                'sort_order' => 1,
            ]
        );

        $seededCount++;
        $productsCount++;
    }
}

echo "SUCCESS: Seeded {$seededCount} verified suppliers across all " . count($upCitiesList) . " Uttar Pradesh cities with {$productsCount} products!\n";
