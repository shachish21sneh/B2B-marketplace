<?php

// Script to build the updated DatabaseSeeder.php with all 26 UP cities and 2+ suppliers per city

$upCitiesList = [
    ['city' => 'Prayagraj', 'pincode' => '211001', 'image' => 'https://images.unsplash.com/photo-1596176530529-78163a4f7af2?w=500&auto=format&fit=crop&q=80',
     's1' => ['company' => 'Prayag Precision Pipes & Industrial Tubes Ltd', 'type' => 'Manufacturer', 'cat' => 'construction-steel-piping', 'prod' => 'ERW Galvanized Steel Pipes & Structural Tubes', 'price' => 64500, 'unit' => 'Ton', 'moq' => 5],
     's2' => ['company' => 'Triveni Heavy Power Cables & Switchgears', 'type' => 'Manufacturer', 'cat' => 'electrical-electronics-cables', 'prod' => 'Armoured XLPE Underground High-Tension Cables', 'price' => 280, 'unit' => 'Meter', 'moq' => 500]
    ],
    ['city' => 'Varanasi', 'pincode' => '221001', 'image' => 'https://images.unsplash.com/photo-1561361513-2d000a50f0dc?w=500&auto=format&fit=crop&q=80',
     's1' => ['company' => 'Kashi Heritage Silk Mills & Handlooms', 'type' => 'Manufacturer', 'cat' => 'textiles-fabrics-workwear', 'prod' => 'Pure Banarasi Katan Silk Brocade Wholesale Fabric', 'price' => 1450, 'unit' => 'Meter', 'moq' => 100],
     's2' => ['company' => 'Banaras Precision Submersible Pumps & Motors', 'type' => 'Manufacturer', 'cat' => 'industrial-machinery', 'prod' => '10 HP Stainless Steel Borewell Submersible Pump', 'price' => 24500, 'unit' => 'Set', 'moq' => 5]
    ],
    ['city' => 'Chandauli', 'pincode' => '232104', 'image' => 'https://images.unsplash.com/photo-1570168007204-dfb528c6958f?w=500&auto=format&fit=crop&q=80',
     's1' => ['company' => 'Chandauli Agro Milling & Grain Processing Units', 'type' => 'Manufacturer', 'cat' => 'agriculture-food-processing', 'prod' => 'Sortex Cleaned Sona Masoori & Non-Basmati Rice', 'price' => 38, 'unit' => 'Kg', 'moq' => 5000],
     's2' => ['company' => 'Purvanchal Industrial Storage Silos & Tanks', 'type' => 'Manufacturer', 'cat' => 'packaging-materials-containers', 'prod' => 'Galvanized Corrugated Grain Storage Silos 50MT', 'price' => 340000, 'unit' => 'Unit', 'moq' => 1]
    ],
    ['city' => 'Ghazipur', 'pincode' => '233001', 'image' => 'https://images.unsplash.com/photo-1587474260584-136574528ed5?w=500&auto=format&fit=crop&q=80',
     's1' => ['company' => 'Ghazipur Natural Aromatics & Herbal Extracts', 'type' => 'Manufacturer', 'cat' => 'chemicals-polymers-plastics', 'prod' => 'Pure Rose Water Distillate & Natural Essential Extracts', 'price' => 450, 'unit' => 'Liter', 'moq' => 100],
     's2' => ['company' => 'Ghazipur Agricultural Sprayers & Farm Tools', 'type' => 'Manufacturer', 'cat' => 'industrial-machinery', 'prod' => '16L Battery Operated Agriculture Knapsack Sprayer', 'price' => 1850, 'unit' => 'Piece', 'moq' => 20]
    ],
    ['city' => 'Jaunpur', 'pincode' => '222001', 'image' => 'https://images.unsplash.com/photo-1606820245089-b1d5c5896a2f?w=500&auto=format&fit=crop&q=80',
     's1' => ['company' => 'Jaunpur Brass Die-Casting & Heavy Metal Works', 'type' => 'Manufacturer', 'cat' => 'hardware-sanitaryware-pipes', 'prod' => 'Forged Brass Plumbing Ball Valves & Couplings', 'price' => 165, 'unit' => 'Piece', 'moq' => 200],
     's2' => ['company' => 'Gomti Agro Processors & Mustard Oil Mills', 'type' => 'Manufacturer', 'cat' => 'agriculture-food-processing', 'prod' => 'Cold Pressed Kachi Ghani Mustard Oil 15L Tin', 'price' => 1950, 'unit' => 'Tin', 'moq' => 50]
    ],
    ['city' => 'Azamgarh', 'pincode' => '276001', 'image' => 'https://images.unsplash.com/photo-1582510003544-4d00b7f74220?w=500&auto=format&fit=crop&q=80',
     's1' => ['company' => 'Mubarakpur Jacquard Weaving & Silk Mills', 'type' => 'Manufacturer', 'cat' => 'textiles-fabrics-workwear', 'prod' => 'Polyester Jacquard Dress Materials & Saree Fabric', 'price' => 240, 'unit' => 'Meter', 'moq' => 250],
     's2' => ['company' => 'Azamgarh CNC Auto Components & Die Works', 'type' => 'Manufacturer', 'cat' => 'automotive-ev-transport', 'prod' => 'Automotive Transmission Shafts & Precision Pinions', 'price' => 420, 'unit' => 'Piece', 'moq' => 100]
    ],
    ['city' => 'Ballia', 'pincode' => '277001', 'image' => 'https://images.unsplash.com/photo-1599661046289-e31897846e41?w=500&auto=format&fit=crop&q=80',
     's1' => ['company' => 'Ballia Solar Power Panels & Lighting Systems', 'type' => 'Manufacturer', 'cat' => 'solar-renewable-energy', 'prod' => '540W Mono PERC Bifacial Solar PV Modules', 'price' => 11200, 'unit' => 'Piece', 'moq' => 10],
     's2' => ['company' => 'Bhrigu Woven Sacks & Jute Packing Co', 'type' => 'Manufacturer', 'cat' => 'packaging-materials-containers', 'prod' => 'HDPE/PP Laminated Heavy Grain Packaging Sacks 50kg', 'price' => 18.5, 'unit' => 'Piece', 'moq' => 2000]
    ],
    ['city' => 'Mau', 'pincode' => '275101', 'image' => 'https://images.unsplash.com/photo-1616088410192-39c4d6836423?w=500&auto=format&fit=crop&q=80',
     's1' => ['company' => 'Mau High-Count Yarn & Powerloom Fabrics Ltd', 'type' => 'Manufacturer', 'cat' => 'textiles-fabrics-workwear', 'prod' => '100% Combed Cotton Ring Spun Weaving Yarn 30s/40s', 'price' => 265, 'unit' => 'Kg', 'moq' => 500],
     's2' => ['company' => 'Sharda Technical Textiles & Waterproof Tarpaulins', 'type' => 'Manufacturer', 'cat' => 'packaging-materials-containers', 'prod' => 'Heavy Duty HDPE Waterproof Truck Tarpaulins 250 GSM', 'price' => 2200, 'unit' => 'Piece', 'moq' => 25]
    ],
    ['city' => 'Gorakhpur', 'pincode' => '273001', 'image' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=500&auto=format&fit=crop&q=80',
     's1' => ['company' => 'Gorakhpur Steel Rerolling & TMT Bars Ltd', 'type' => 'Manufacturer', 'cat' => 'construction-steel-piping', 'prod' => 'Fe-550D High Ductility Earthquake Resistant TMT Bars', 'price' => 58500, 'unit' => 'Ton', 'moq' => 10],
     's2' => ['company' => 'Gorakshnath Precision Foundry & Industrial Valves', 'type' => 'Manufacturer', 'cat' => 'industrial-machinery', 'prod' => 'Cast Iron Sluice Valves & Flanged Gate Valves Class 150', 'price' => 4800, 'unit' => 'Piece', 'moq' => 10]
    ],
    ['city' => 'Deoria', 'pincode' => '274001', 'image' => 'https://images.unsplash.com/photo-1605007493699-af65834f8a00?w=500&auto=format&fit=crop&q=80',
     's1' => ['company' => 'Deoria Bio-Energy & Refined Sugar Industries', 'type' => 'Manufacturer', 'cat' => 'agriculture-food-processing', 'prod' => 'S-30 Plantation White Refined Crystal Sugar 50kg Bag', 'price' => 3850, 'unit' => 'Quintal', 'moq' => 100],
     's2' => ['company' => 'Deoria Tractor Implements & Rotavators Works', 'type' => 'Manufacturer', 'cat' => 'industrial-machinery', 'prod' => 'Multi-Speed Gearbox 7 Feet Heavy Duty Rotavator', 'price' => 98000, 'unit' => 'Unit', 'moq' => 2]
    ],
    ['city' => 'Kushinagar', 'pincode' => '274402', 'image' => 'https://images.unsplash.com/photo-1558431382-27e303142255?w=500&auto=format&fit=crop&q=80',
     's1' => ['company' => 'Kushinagar Cold Chain & Agro Exporters', 'type' => 'Exporter', 'cat' => 'agriculture-food-processing', 'prod' => 'Export Grade Fresh Red Onions & Processed Garlic Mash', 'price' => 32, 'unit' => 'Kg', 'moq' => 3000],
     's2' => ['company' => 'Buddha Circuit Corrugated Box & Packaging Units', 'type' => 'Manufacturer', 'cat' => 'packaging-materials-containers', 'prod' => '5-Ply Heavy Printed Kraft Corrugated Shipping Cartons', 'price' => 34, 'unit' => 'Piece', 'moq' => 1000]
    ],
    ['city' => 'Maharajganj', 'pincode' => '273303', 'image' => 'https://images.unsplash.com/photo-1590496793929-36417d3117de?w=500&auto=format&fit=crop&q=80',
     's1' => ['company' => 'Maharajganj Timber Seasoning & Commercial Ply Works', 'type' => 'Manufacturer', 'cat' => 'furniture-commercial-office', 'prod' => 'BWP Marine Grade Calibrated Plywood 18mm Sheets', 'price' => 88, 'unit' => 'Sq Ft', 'moq' => 100],
     's2' => ['company' => 'Tarai Wire Mesh & Heavy Fencing Solutions', 'type' => 'Manufacturer', 'cat' => 'hardware-sanitaryware-pipes', 'prod' => 'GI Galvanized Chain Link Boundary Wire Mesh 10 Gauge', 'price' => 85, 'unit' => 'Kg', 'moq' => 500]
    ],
    ['city' => 'Basti', 'pincode' => '272001', 'image' => 'https://images.unsplash.com/photo-1562975871-33230b777a83?w=500&auto=format&fit=crop&q=80',
     's1' => ['company' => 'Basti Kraft Paper & Fluting Board Mills Ltd', 'type' => 'Manufacturer', 'cat' => 'packaging-materials-containers', 'prod' => 'High BF Semi-Kraft Paper Reels 140-200 GSM for Boxes', 'price' => 36, 'unit' => 'Kg', 'moq' => 5000],
     's2' => ['company' => 'Basti Agro Harvester Blades & Forgings', 'type' => 'Manufacturer', 'cat' => 'industrial-machinery', 'prod' => 'High Carbon Steel Combine Harvester Straw Blades', 'price' => 95, 'unit' => 'Piece', 'moq' => 200]
    ],
    ['city' => 'Sant Kabir Nagar', 'pincode' => '272175', 'image' => 'https://images.unsplash.com/photo-1587474260584-136574528ed5?w=500&auto=format&fit=crop&q=80',
     's1' => ['company' => 'Khalilabad Cotton Fabrics & Hosiery Mills', 'type' => 'Manufacturer', 'cat' => 'textiles-fabrics-workwear', 'prod' => 'Knitted Single Jersey Cotton T-Shirt Fabric 180 GSM', 'price' => 290, 'unit' => 'Kg', 'moq' => 250],
     's2' => ['company' => 'Sant Kabir Brass & Aluminum Utensil Casting Works', 'type' => 'Manufacturer', 'cat' => 'hardware-sanitaryware-pipes', 'prod' => 'Commercial Heavy Die-Cast Aluminum Cauldron & Utensils', 'price' => 275, 'unit' => 'Kg', 'moq' => 100]
    ],
    ['city' => 'Siddharthnagar', 'pincode' => '272207', 'image' => 'https://images.unsplash.com/photo-1570168007204-dfb528c6958f?w=500&auto=format&fit=crop&q=80',
     's1' => ['company' => 'Siddharthnagar Organic Kalanamak Rice Exports', 'type' => 'Exporter', 'cat' => 'agriculture-food-processing', 'prod' => 'GI Tagged Heritage Aromatic Kalanamak Buddha Rice', 'price' => 140, 'unit' => 'Kg', 'moq' => 500],
     's2' => ['company' => 'Kapilvastu Agri Spares & Tillage Tools', 'type' => 'Manufacturer', 'cat' => 'industrial-machinery', 'prod' => '9-Tyne Rigid Cultivator Shovels & Spring Loaded Tillers', 'price' => 28500, 'unit' => 'Unit', 'moq' => 5]
    ],
    ['city' => 'Mirzapur', 'pincode' => '231001', 'image' => 'https://images.unsplash.com/photo-1582510003544-4d00b7f74220?w=500&auto=format&fit=crop&q=80',
     's1' => ['company' => 'Vindhya Natural Stone & Slate Tiles Consortium', 'type' => 'Manufacturer', 'cat' => 'construction-steel-piping', 'prod' => 'Chunar Natural Sandstone Slabs & Paving Cobbles', 'price' => 65, 'unit' => 'Sq Ft', 'moq' => 500],
     's2' => ['company' => 'Mirzapur Heritage Hand-Knotted Woolen Carpets', 'type' => 'Manufacturer', 'cat' => 'textiles-fabrics-workwear', 'prod' => 'Hand Knotted Persian Design New Zealand Wool Carpets', 'price' => 550, 'unit' => 'Sq Ft', 'moq' => 100]
    ],
    ['city' => 'Sonbhadra', 'pincode' => '231216', 'image' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=500&auto=format&fit=crop&q=80',
     's1' => ['company' => 'Sonbhadra Heavy Mining Machinery & Excavator Spares', 'type' => 'Manufacturer', 'cat' => 'industrial-machinery', 'prod' => 'Forged Hardened Excavator Bucket Teeth & Adapters', 'price' => 1450, 'unit' => 'Piece', 'moq' => 20],
     's2' => ['company' => 'Rihand High Tension Conductors & Power Cables', 'type' => 'Manufacturer', 'cat' => 'electrical-electronics-cables', 'prod' => 'ACSR Zebra & Panther Overhead Transmission Conductors', 'price' => 185, 'unit' => 'Meter', 'moq' => 1000]
    ],
    ['city' => 'Bhadohi', 'pincode' => '221401', 'image' => 'https://images.unsplash.com/photo-1558431382-27e303142255?w=500&auto=format&fit=crop&q=80',
     's1' => ['company' => 'Bhadohi Oriental Tufted Rugs & Export Carpets', 'type' => 'Exporter', 'cat' => 'textiles-fabrics-workwear', 'prod' => 'Hand Tufted Modern Geometric Wool Area Rugs 8x10 Ft', 'price' => 12500, 'unit' => 'Piece', 'moq' => 10],
     's2' => ['company' => 'Eastern UP Floor Coverings & Wool Spun Fibres', 'type' => 'Manufacturer', 'cat' => 'textiles-fabrics-workwear', 'prod' => 'Semi-Worsted Carpet Weaving Wool Yarn Hanks 60 Nm', 'price' => 480, 'unit' => 'Kg', 'moq' => 200]
    ],
    ['city' => 'Ayodhya', 'pincode' => '224001', 'image' => 'https://images.unsplash.com/photo-1605007493699-af65834f8a00?w=500&auto=format&fit=crop&q=80',
     's1' => ['company' => 'Ayodhya Solar Infra & Rooftop Systems Ltd', 'type' => 'Manufacturer', 'cat' => 'solar-renewable-energy', 'prod' => 'Complete 10 kW Commercial On-Grid Solar Inverter & Array', 'price' => 420000, 'unit' => 'System', 'moq' => 1],
     's2' => ['company' => 'Ram Janmabhoomi Brassware & Architectural Hardware', 'type' => 'Manufacturer', 'cat' => 'hardware-sanitaryware-pipes', 'prod' => 'Traditional Cast Brass Main Door Handles & Mortise Locks', 'price' => 850, 'unit' => 'Set', 'moq' => 50]
    ],
    ['city' => 'Ambedkar Nagar', 'pincode' => '224122', 'image' => 'https://images.unsplash.com/photo-1596176530529-78163a4f7af2?w=500&auto=format&fit=crop&q=80',
     's1' => ['company' => 'Tanda Powerloom Cotton & Polyester Cloth Mills', 'type' => 'Manufacturer', 'cat' => 'textiles-fabrics-workwear', 'prod' => 'Bleached Cotton Poplin Uniform Fabric 58 Inch Width', 'price' => 68, 'unit' => 'Meter', 'moq' => 500],
     's2' => ['company' => 'Ambedkar Nagar Structural Steel & Truss Works', 'type' => 'Manufacturer', 'cat' => 'construction-steel-piping', 'prod' => 'Pre-Engineered Building (PEB) Structural Steel Trusses', 'price' => 62000, 'unit' => 'Ton', 'moq' => 5]
    ],
    ['city' => 'Sultanpur', 'pincode' => '228001', 'image' => 'https://images.unsplash.com/photo-1561361513-2d000a50f0dc?w=500&auto=format&fit=crop&q=80',
     's1' => ['company' => 'Sultanpur Electrical Transformers & Switchgears', 'type' => 'Manufacturer', 'cat' => 'electrical-electronics-cables', 'prod' => '100 kVA 11kV/415V Three Phase Oil Cooled Distribution Transformer', 'price' => 165000, 'unit' => 'Unit', 'moq' => 1],
     's2' => ['company' => 'Sultanpur Hybrid Seeds & Agricultural Bio-Nutrients', 'type' => 'Manufacturer', 'cat' => 'chemicals-polymers-plastics', 'prod' => 'Liquid Bio-NPK Microbial Fertilizer & Soil Conditioners', 'price' => 320, 'unit' => 'Liter', 'moq' => 100]
    ],
    ['city' => 'Pratapgarh', 'pincode' => '230001', 'image' => 'https://images.unsplash.com/photo-1570168007204-dfb528c6958f?w=500&auto=format&fit=crop&q=80',
     's1' => ['company' => 'Pratapgarh Amla Processing & Herbal Health Extracts', 'type' => 'Manufacturer', 'cat' => 'medical-pharma-healthcare', 'prod' => 'Pure Organic Amla Juice Extract & Powder 50kg Drum', 'price' => 180, 'unit' => 'Kg', 'moq' => 200],
     's2' => ['company' => 'Pratapgarh Spun Concrete Poles & Drainage Pipes', 'type' => 'Manufacturer', 'cat' => 'construction-steel-piping', 'prod' => 'RCC Spun Reinforced Concrete Drainage Pipes Class NP3', 'price' => 1850, 'unit' => 'Meter', 'moq' => 50]
    ],
    ['city' => 'Gonda', 'pincode' => '271001', 'image' => 'https://images.unsplash.com/photo-1587474260584-136574528ed5?w=500&auto=format&fit=crop&q=80',
     's1' => ['company' => 'Gonda Precision Farm Implements & Tillage Blades', 'type' => 'Manufacturer', 'cat' => 'industrial-machinery', 'prod' => 'Heavy Disc Harrow 16-Disc Hydraulic Trailing Type', 'price' => 74000, 'unit' => 'Unit', 'moq' => 2],
     's2' => ['company' => 'Devipatan Roller Flour & Industrial Grain Mills', 'type' => 'Manufacturer', 'cat' => 'agriculture-food-processing', 'prod' => 'Industrial Grade Bakery Maida & Semolina 50kg Bags', 'price' => 1650, 'unit' => 'Bag', 'moq' => 100]
    ],
    ['city' => 'Bahraich', 'pincode' => '271801', 'image' => 'https://images.unsplash.com/photo-1606820245089-b1d5c5896a2f?w=500&auto=format&fit=crop&q=80',
     's1' => ['company' => 'Bahraich Commercial Plywood & Timber Works', 'type' => 'Manufacturer', 'cat' => 'furniture-commercial-office', 'prod' => 'Commercial MR Grade Hardwood Core Plywood 12mm', 'price' => 64, 'unit' => 'Sq Ft', 'moq' => 150],
     's2' => ['company' => 'Bahraich Natural Mentha & Essential Oil Distilleries', 'type' => 'Manufacturer', 'cat' => 'chemicals-polymers-plastics', 'prod' => 'Pure Mentha Arvensis Peppermint Oil Crystal 99% BP', 'price' => 1250, 'unit' => 'Kg', 'moq' => 50]
    ],
    ['city' => 'Shravasti', 'pincode' => '271831', 'image' => 'https://images.unsplash.com/photo-1582510003544-4d00b7f74220?w=500&auto=format&fit=crop&q=80',
     's1' => ['company' => 'Shravasti Modern Rice Mill & Silo Processing', 'type' => 'Manufacturer', 'cat' => 'agriculture-food-processing', 'prod' => 'Premium Long Grain Parboiled Rice Silo Cleaned', 'price' => 42, 'unit' => 'Kg', 'moq' => 5000],
     's2' => ['company' => 'Shravasti Fly Ash Bricks & Concrete Block Plant', 'type' => 'Manufacturer', 'cat' => 'construction-steel-piping', 'prod' => 'High Strength Hydraulic Compressed Fly Ash Bricks', 'price' => 6.5, 'unit' => 'Piece', 'moq' => 5000]
    ],
    ['city' => 'Balrampur', 'pincode' => '271201', 'image' => 'https://images.unsplash.com/photo-1599661046289-e31897846e41?w=500&auto=format&fit=crop&q=80',
     's1' => ['company' => 'Balrampur Bio-Energy & Industrial Refinery Ltd', 'type' => 'Manufacturer', 'cat' => 'chemicals-polymers-plastics', 'prod' => 'Anhydrous Ethanol Fuel Grade 99.5% for Industrial Blends', 'price' => 62, 'unit' => 'Liter', 'moq' => 10000],
     's2' => ['company' => 'Balrampur Heavy Barbed Wire & Chainlink Works', 'type' => 'Manufacturer', 'cat' => 'hardware-sanitaryware-pipes', 'prod' => 'High Tensile Galvanized Barbed Security Fencing Wire', 'price' => 78, 'unit' => 'Kg', 'moq' => 500]
    ]
];

echo "Parsed " . count($upCitiesList) . " Uttar Pradesh cities.\n";
