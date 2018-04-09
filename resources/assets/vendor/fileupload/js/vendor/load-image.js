!function(e) {
    "use strict";
    function t(e, i, a) {
        var o,
            r=document.createElement("img");
        if(r.onerror=function(o) {
                return t.onerror(r, o, e, i, a)
            }
                , r.onload=function(o) {
                return t.onload(r, o, e, i, a)
            }
                , t.isInstanceOf("Blob", e)||t.isInstanceOf("File", e))o=r._objectURL=t.createObjectURL(e);
        else {
            if("string"!=typeof e)return!1;
            o=e,
            a&&a.crossOrigin&&(r.crossOrigin=a.crossOrigin)
        }
        return o?(r.src=o, r):t.readFile(e, function(e) {
                var t=e.target;
                t&&t.result?r.src=t.result: i&&i(e)
            }
        )
    }
    function i(e, i) {
        !e._objectURL||i&&i.noRevoke||(t.revokeObjectURL(e._objectURL), delete e._objectURL)
    }
    var a=window.createObjectURL&&window||window.URL&&URL.revokeObjectURL&&URL||window.webkitURL&&webkitURL;
    t.isInstanceOf=function(e, t) {
        return Object.prototype.toString.call(t)==="[object "+e+"]"
    }
        ,
        t.transform=function(e, i, a, o, r) {
            a(t.scale(e, i, r), r)
        }
        ,
        t.onerror=function(e, t, a, o, r) {
            i(e, r),
            o&&o.call(e, t)
        }
        ,
        t.onload=function(e, a, o, r, n) {
            i(e, n),
            r&&t.transform(e, n, r, o, {}
            )
        }
        ,
        t.transformCoordinates=function() {}
        ,
        t.getTransformedOptions=function(e, t) {
            var i,
                a,
                o,
                r,
                n=t.aspectRatio;
            if(!n)return t;
            i= {}
            ;
            for(a in t)t.hasOwnProperty(a)&&(i[a]=t[a]);
            return i.crop=!0,
                o=e.naturalWidth||e.width,
                r=e.naturalHeight||e.height,
                o/r>n?(i.maxWidth=r*n, i.maxHeight=r): (i.maxWidth=o, i.maxHeight=o/n), i
        }
        ,
        t.renderImageToCanvas=function(e, t, i, a, o, r, n, s, l, d) {
            return e.getContext("2d").drawImage(t, i, a, o, r, n, s, l, d),
                e
        }
        ,
        t.hasCanvasOption=function(e) {
            return e.canvas||e.crop||!!e.aspectRatio
        }
        ,
        t.scale=function(e, i, a) {
            function o() {
                var e=Math.max((l||v)/v, (d||P)/P);
                e>1&&(v*=e, P*=e)
            }
            function r() {
                var e=Math.min((n||v)/v, (s||P)/P);
                e<1&&(v*=e, P*=e)
            }
            i=i|| {}
            ;
            var n,
                s,
                l,
                d,
                u,
                c,
                f,
                g,
                h,
                m,
                p,
                S=document.createElement("canvas"),
                b=e.getContext||t.hasCanvasOption(i)&&S.getContext,
                x=e.naturalWidth||e.width,
                y=e.naturalHeight||e.height,
                v=x,
                P=y;
            if(b&&(i=t.getTransformedOptions(e, i, a), f=i.left||0, g=i.top||0, i.sourceWidth?(u=i.sourceWidth, void 0!==i.right&&void 0===i.left&&(f=x-u-i.right)):u=x-f-(i.right||0), i.sourceHeight?(c=i.sourceHeight, void 0!==i.bottom&&void 0===i.top&&(g=y-c-i.bottom)):c=y-g-(i.bottom||0), v=u, P=c), n=i.maxWidth, s=i.maxHeight, l=i.minWidth, d=i.minHeight, b&&n&&s&&i.crop?(v=n, P=s, p=u/c-n/s, p<0?(c=s*u/n, void 0===i.top&&void 0===i.bottom&&(g=(y-c)/2)):p>0&&(u=n*c/s, void 0===i.left&&void 0===i.right&&(f=(x-u)/2))):((i.contain||i.cover)&&(l=n=n||l, d=s=s||d), i.cover?(r(), o()):(o(), r())), b) {
                if(h=i.pixelRatio, h>1&&(S.style.width=v+"px", S.style.height=P+"px", v*=h, P*=h, S.getContext("2d").scale(h, h)), m=i.downsamplingRatio, m>0&&m<1&&v<u&&P<c)for(;
                    u*m>v;
                )S.width=u*m,
                        S.height=c*m,
                        t.renderImageToCanvas(S, e, f, g, u, c, 0, 0, S.width, S.height),
                        u=S.width,
                        c=S.height,
                        e=document.createElement("canvas"),
                        e.width=u,
                        e.height=c,
                        t.renderImageToCanvas(e, S, 0, 0, u, c, 0, 0, u, c);
                return S.width=v,
                    S.height=P,
                    t.transformCoordinates(S, i),
                    t.renderImageToCanvas(S, e, f, g, u, c, 0, 0, v, P)
            }
            return e.width=v,
                e.height=P,
                e
        }
        ,
        t.createObjectURL=function(e) {
            return!!a&&a.createObjectURL(e)
        }
        ,
        t.revokeObjectURL=function(e) {
            return!!a&&a.revokeObjectURL(e)
        }
        ,
        t.readFile=function(e, t, i) {
            if(window.FileReader) {
                var a=new FileReader;
                if(a.onload=a.onerror=t, i=i||"readAsDataURL", a[i])return a[i](e),
                    a
            }
            return!1
        }
        ,
        e.loadImage=t
}

(window),
    function(e) {
        "use strict";
        e(window.loadImage)
    }

    (function(e) {
            "use strict";
            var t=window.Blob&&(Blob.prototype.slice||Blob.prototype.webkitSlice||Blob.prototype.mozSlice);
            e.blobSlice=t&&function() {
                    var e=this.slice||this.webkitSlice||this.mozSlice;
                    return e.apply(this, arguments)
                }
                , e.metaDataParsers= {
                jpeg: {
                    65505: []
                }
            }
                , e.parseMetaData=function(t, i, a, o) {
                a=a|| {}
                    , o=o|| {}
                ;
                var r=this, n=a.maxMetaDataSize||262144, s=!(window.DataView&&t&&t.size>=12&&"image/jpeg"===t.type&&e.blobSlice);
                !s&&e.readFile(e.blobSlice.call(t, 0, n), function(t) {
                        if(t.target.error)return console.log(t.target.error), void i(o);
                        var n, s, l, d, u=t.target.result, c=new DataView(u), f=2, g=c.byteLength-4, h=f;
                        if(65496===c.getUint16(0)) {
                            for(;
                                f<g&&(n=c.getUint16(f), n>=65504&&n<=65519||65534===n);
                            ) {
                                if(s=c.getUint16(f+2)+2, f+s>c.byteLength) {
                                    console.log("Invalid meta data: Invalid segment size.");
                                    break
                                }
                                if(l=e.metaDataParsers.jpeg[n])for(d=0;
                                                                   d<l.length;
                                                                   d+=1)l[d].call(r, c, f, s, o, a);
                                f+=s, h=f
                            }
                            !a.disableImageHead&&h>6&&(u.slice?o.imageHead=u.slice(0, h):o.imageHead=new Uint8Array(u).subarray(0, h))
                        }
                        else console.log("Invalid JPEG file: Missing JPEG marker.");
                        i(o)
                    }
                    , "readAsArrayBuffer")||i(o)
            }
                , e.hasMetaOption=function(e) {
                return e.meta
            }
            ;
            var i=e.transform;
            e.transform=function(t, a, o, r, n) {
                e.hasMetaOption(a|| {}
                )?e.parseMetaData(r, function(n) {
                        i.call(e, t, a, o, r, n)
                    }
                    , a, n):i.apply(e, arguments)
            }
        }

    ),
    function(e) {
        "use strict";
        e(window.loadImage)
    }

    (function(e) {
            "use strict";
            e.ExifMap=function() {
                return this
            }
                , e.ExifMap.prototype.map= {
                Orientation: 274
            }
                , e.ExifMap.prototype.get=function(e) {
                return this[e]||this[this.map[e]]
            }
                , e.getExifThumbnail=function(e, t, i) {
                var a, o, r;
                if(!i||t+i>e.byteLength)return void console.log("Invalid Exif data: Invalid thumbnail data.");
                for(a=[], o=0;
                    o<i;
                    o+=1)r=e.getUint8(t+o), a.push((r<16?"0": "")+r.toString(16));
                return"data:image/jpeg,%"+a.join("%")
            }
                , e.exifTagTypes= {
                1: {
                    getValue:function(e, t) {
                        return e.getUint8(t)
                    }
                    , size:1
                }
                , 2: {
                    getValue:function(e, t) {
                        return String.fromCharCode(e.getUint8(t))
                    }
                    , size:1, ascii:!0
                }
                , 3: {
                    getValue:function(e, t, i) {
                        return e.getUint16(t, i)
                    }
                    , size:2
                }
                , 4: {
                    getValue:function(e, t, i) {
                        return e.getUint32(t, i)
                    }
                    , size:4
                }
                , 5: {
                    getValue:function(e, t, i) {
                        return e.getUint32(t, i)/e.getUint32(t+4, i)
                    }
                    , size:8
                }
                , 9: {
                    getValue:function(e, t, i) {
                        return e.getInt32(t, i)
                    }
                    , size:4
                }
                , 10: {
                    getValue:function(e, t, i) {
                        return e.getInt32(t, i)/e.getInt32(t+4, i)
                    }
                    , size:8
                }
            }
                , e.exifTagTypes[7]=e.exifTagTypes[1], e.getExifValue=function(t, i, a, o, r, n) {
                var s, l, d, u, c, f, g=e.exifTagTypes[o];
                if(!g)return void console.log("Invalid Exif data: Invalid tag type.");
                if(s=g.size*r, l=s>4?i+t.getUint32(a+8, n): a+8, l+s>t.byteLength)return void console.log("Invalid Exif data: Invalid data offset.");
                if(1===r)return g.getValue(t, l, n);
                for(d=[], u=0;
                    u<r;
                    u+=1)d[u]=g.getValue(t, l+u*g.size, n);
                if(g.ascii) {
                    for(c="", u=0;
                        u<d.length&&(f=d[u], "\0"!==f);
                        u+=1)c+=f;
                    return c
                }
                return d
            }
                , e.parseExifTag=function(t, i, a, o, r) {
                var n=t.getUint16(a, o);
                r.exif[n]=e.getExifValue(t, i, a, t.getUint16(a+2, o), t.getUint32(a+4, o), o)
            }
                , e.parseExifTags=function(e, t, i, a, o) {
                var r, n, s;
                if(i+6>e.byteLength)return void console.log("Invalid Exif data: Invalid directory offset.");
                if(r=e.getUint16(i, a), n=i+2+12*r, n+4>e.byteLength)return void console.log("Invalid Exif data: Invalid directory size.");
                for(s=0;
                    s<r;
                    s+=1)this.parseExifTag(e, t, i+2+12*s, a, o);
                return e.getUint32(n, a)
            }
                , e.parseExifData=function(t, i, a, o, r) {
                if(!r.disableExif) {
                    var n, s, l, d=i+10;
                    if(1165519206===t.getUint32(i+4)) {
                        if(d+8>t.byteLength)return void console.log("Invalid Exif data: Invalid segment size.");
                        if(0!==t.getUint16(i+8))return void console.log("Invalid Exif data: Missing byte alignment offset.");
                        switch(t.getUint16(d)) {
                            case 18761: n=!0;
                                break;
                            case 19789: n=!1;
                                break;
                            default: return void console.log("Invalid Exif data: Invalid byte alignment marker.")
                        }
                        if(42!==t.getUint16(d+2, n))return void console.log("Invalid Exif data: Missing TIFF marker.");
                        s=t.getUint32(d+4, n), o.exif=new e.ExifMap, s=e.parseExifTags(t, d, d+s, n, o), s&&!r.disableExifThumbnail&&(l= {
                            exif: {}
                        }
                            , s=e.parseExifTags(t, d, d+s, n, l), l.exif[513]&&(o.exif.Thumbnail=e.getExifThumbnail(t, d+l.exif[513], l.exif[514]))), o.exif[34665]&&!r.disableExifSub&&e.parseExifTags(t, d, d+o.exif[34665], n, o), o.exif[34853]&&!r.disableExifGps&&e.parseExifTags(t, d, d+o.exif[34853], n, o)
                    }
                }
            }
                , e.metaDataParsers.jpeg[65505].push(e.parseExifData)
        }

    ),
    function(e) {
        "use strict";
        e(window.loadImage)
    }

    (function(e) {
            "use strict";
            e.ExifMap.prototype.tags= {
                256: "ImageWidth", 257: "ImageHeight", 34665: "ExifIFDPointer", 34853: "GPSInfoIFDPointer", 40965: "InteroperabilityIFDPointer", 258: "BitsPerSample", 259: "Compression", 262: "PhotometricInterpretation", 274: "Orientation", 277: "SamplesPerPixel", 284: "PlanarConfiguration", 530: "YCbCrSubSampling", 531: "YCbCrPositioning", 282: "XResolution", 283: "YResolution", 296: "ResolutionUnit", 273: "StripOffsets", 278: "RowsPerStrip", 279: "StripByteCounts", 513: "JPEGInterchangeFormat", 514: "JPEGInterchangeFormatLength", 301: "TransferFunction", 318: "WhitePoint", 319: "PrimaryChromaticities", 529: "YCbCrCoefficients", 532: "ReferenceBlackWhite", 306: "DateTime", 270: "ImageDescription", 271: "Make", 272: "Model", 305: "Software", 315: "Artist", 33432: "Copyright", 36864: "ExifVersion", 40960: "FlashpixVersion", 40961: "ColorSpace", 40962: "PixelXDimension", 40963: "PixelYDimension", 42240: "Gamma", 37121: "ComponentsConfiguration", 37122: "CompressedBitsPerPixel", 37500: "MakerNote", 37510: "UserComment", 40964: "RelatedSoundFile", 36867: "DateTimeOriginal", 36868: "DateTimeDigitized", 37520: "SubSecTime", 37521: "SubSecTimeOriginal", 37522: "SubSecTimeDigitized", 33434: "ExposureTime", 33437: "FNumber", 34850: "ExposureProgram", 34852: "SpectralSensitivity", 34855: "PhotographicSensitivity", 34856: "OECF", 34864: "SensitivityType", 34865: "StandardOutputSensitivity", 34866: "RecommendedExposureIndex", 34867: "ISOSpeed", 34868: "ISOSpeedLatitudeyyy", 34869: "ISOSpeedLatitudezzz", 37377: "ShutterSpeedValue", 37378: "ApertureValue", 37379: "BrightnessValue", 37380: "ExposureBias", 37381: "MaxApertureValue", 37382: "SubjectDistance", 37383: "MeteringMode", 37384: "LightSource", 37385: "Flash", 37396: "SubjectArea", 37386: "FocalLength", 41483: "FlashEnergy", 41484: "SpatialFrequencyResponse", 41486: "FocalPlaneXResolution", 41487: "FocalPlaneYResolution", 41488: "FocalPlaneResolutionUnit", 41492: "SubjectLocation", 41493: "ExposureIndex", 41495: "SensingMethod", 41728: "FileSource", 41729: "SceneType", 41730: "CFAPattern", 41985: "CustomRendered", 41986: "ExposureMode", 41987: "WhiteBalance", 41988: "DigitalZoomRatio", 41989: "FocalLengthIn35mmFilm", 41990: "SceneCaptureType", 41991: "GainControl", 41992: "Contrast", 41993: "Saturation", 41994: "Sharpness", 41995: "DeviceSettingDescription", 41996: "SubjectDistanceRange", 42016: "ImageUniqueID", 42032: "CameraOwnerName", 42033: "BodySerialNumber", 42034: "LensSpecification", 42035: "LensMake", 42036: "LensModel", 42037: "LensSerialNumber", 0: "GPSVersionID", 1: "GPSLatitudeRef", 2: "GPSLatitude", 3: "GPSLongitudeRef", 4: "GPSLongitude", 5: "GPSAltitudeRef", 6: "GPSAltitude", 7: "GPSTimeStamp", 8: "GPSSatellites", 9: "GPSStatus", 10: "GPSMeasureMode", 11: "GPSDOP", 12: "GPSSpeedRef", 13: "GPSSpeed", 14: "GPSTrackRef", 15: "GPSTrack", 16: "GPSImgDirectionRef", 17: "GPSImgDirection", 18: "GPSMapDatum", 19: "GPSDestLatitudeRef", 20: "GPSDestLatitude", 21: "GPSDestLongitudeRef", 22: "GPSDestLongitude", 23: "GPSDestBearingRef", 24: "GPSDestBearing", 25: "GPSDestDistanceRef", 26: "GPSDestDistance", 27: "GPSProcessingMethod", 28: "GPSAreaInformation", 29: "GPSDateStamp", 30: "GPSDifferential", 31: "GPSHPositioningError"
            }
                , e.ExifMap.prototype.stringValues= {
                ExposureProgram: {
                    0: "Undefined", 1: "Manual", 2: "Normal program", 3: "Aperture priority", 4: "Shutter priority", 5: "Creative program", 6: "Action program", 7: "Portrait mode", 8: "Landscape mode"
                }
                , MeteringMode: {
                    0: "Unknown", 1: "Average", 2: "CenterWeightedAverage", 3: "Spot", 4: "MultiSpot", 5: "Pattern", 6: "Partial", 255: "Other"
                }
                , LightSource: {
                    0: "Unknown", 1: "Daylight", 2: "Fluorescent", 3: "Tungsten (incandescent light)", 4: "Flash", 9: "Fine weather", 10: "Cloudy weather", 11: "Shade", 12: "Daylight fluorescent (D 5700 - 7100K)", 13: "Day white fluorescent (N 4600 - 5400K)", 14: "Cool white fluorescent (W 3900 - 4500K)", 15: "White fluorescent (WW 3200 - 3700K)", 17: "Standard light A", 18: "Standard light B", 19: "Standard light C", 20: "D55", 21: "D65", 22: "D75", 23: "D50", 24: "ISO studio tungsten", 255: "Other"
                }
                , Flash: {
                    0: "Flash did not fire", 1: "Flash fired", 5: "Strobe return light not detected", 7: "Strobe return light detected", 9: "Flash fired, compulsory flash mode", 13: "Flash fired, compulsory flash mode, return light not detected", 15: "Flash fired, compulsory flash mode, return light detected", 16: "Flash did not fire, compulsory flash mode", 24: "Flash did not fire, auto mode", 25: "Flash fired, auto mode", 29: "Flash fired, auto mode, return light not detected", 31: "Flash fired, auto mode, return light detected", 32: "No flash function", 65: "Flash fired, red-eye reduction mode", 69: "Flash fired, red-eye reduction mode, return light not detected", 71: "Flash fired, red-eye reduction mode, return light detected", 73: "Flash fired, compulsory flash mode, red-eye reduction mode", 77: "Flash fired, compulsory flash mode, red-eye reduction mode, return light not detected", 79: "Flash fired, compulsory flash mode, red-eye reduction mode, return light detected", 89: "Flash fired, auto mode, red-eye reduction mode", 93: "Flash fired, auto mode, return light not detected, red-eye reduction mode", 95: "Flash fired, auto mode, return light detected, red-eye reduction mode"
                }
                , SensingMethod: {
                    1: "Undefined", 2: "One-chip color area sensor", 3: "Two-chip color area sensor", 4: "Three-chip color area sensor", 5: "Color sequential area sensor", 7: "Trilinear sensor", 8: "Color sequential linear sensor"
                }
                , SceneCaptureType: {
                    0: "Standard", 1: "Landscape", 2: "Portrait", 3: "Night scene"
                }
                , SceneType: {
                    1: "Directly photographed"
                }
                , CustomRendered: {
                    0: "Normal process", 1: "Custom process"
                }
                , WhiteBalance: {
                    0: "Auto white balance", 1: "Manual white balance"
                }
                , GainControl: {
                    0: "None", 1: "Low gain up", 2: "High gain up", 3: "Low gain down", 4: "High gain down"
                }
                , Contrast: {
                    0: "Normal", 1: "Soft", 2: "Hard"
                }
                , Saturation: {
                    0: "Normal", 1: "Low saturation", 2: "High saturation"
                }
                , Sharpness: {
                    0: "Normal", 1: "Soft", 2: "Hard"
                }
                , SubjectDistanceRange: {
                    0: "Unknown", 1: "Macro", 2: "Close view", 3: "Distant view"
                }
                , FileSource: {
                    3: "DSC"
                }
                , ComponentsConfiguration: {
                    0: "", 1: "Y", 2: "Cb", 3: "Cr", 4: "R", 5: "G", 6: "B"
                }
                , Orientation: {
                    1: "top-left", 2: "top-right", 3: "bottom-right", 4: "bottom-left", 5: "left-top", 6: "right-top", 7: "right-bottom", 8: "left-bottom"
                }
            }
                , e.ExifMap.prototype.getText=function(e) {
                var t=this.get(e);
                switch(e) {
                    case"LightSource": case"Flash": case"MeteringMode": case"ExposureProgram": case"SensingMethod": case"SceneCaptureType": case"SceneType": case"CustomRendered": case"WhiteBalance": case"GainControl": case"Contrast": case"Saturation": case"Sharpness": case"SubjectDistanceRange": case"FileSource": case"Orientation": return this.stringValues[e][t];
                    case"ExifVersion": case"FlashpixVersion": if(!t)return;
                    return String.fromCharCode(t[0], t[1], t[2], t[3]);
                    case"ComponentsConfiguration": if(!t)return;
                        return this.stringValues[e][t[0]]+this.stringValues[e][t[1]]+this.stringValues[e][t[2]]+this.stringValues[e][t[3]];
                    case"GPSVersionID": if(!t)return;
                        return t[0]+"."+t[1]+"."+t[2]+"."+t[3]
                }
                return String(t)
            }
                , function(e) {
                var t, i=e.tags, a=e.map;
                for(t in i)i.hasOwnProperty(t)&&(a[i[t]]=t)
            }
            (e.ExifMap.prototype), e.ExifMap.prototype.getAll=function() {
                var e, t, i= {}
                    ;
                for(e in this)this.hasOwnProperty(e)&&(t=this.tags[e], t&&(i[t]=this.getText(t)));
                return i
            }
        }

    ),
    function(e) {
        "use strict";
        e(window.loadImage)
    }

    (function(e) {
            "use strict";
            var t=e.hasCanvasOption, i=e.hasMetaOption, a=e.transformCoordinates, o=e.getTransformedOptions;
            e.hasCanvasOption=function(i) {
                return!!i.orientation||t.call(e, i)
            }
                , e.hasMetaOption=function(t) {
                return t.orientation===!0||i.call(e, t)
            }
                , e.transformCoordinates=function(t, i) {
                a.call(e, t, i);
                var o=t.getContext("2d"), r=t.width, n=t.height, s=t.style.width, l=t.style.height, d=i.orientation;
                if(d&&!(d>8))switch(d>4&&(t.width=n, t.height=r, t.style.width=l, t.style.height=s), d) {
                    case 2: o.translate(r, 0), o.scale(-1, 1);
                        break;
                    case 3: o.translate(r, n), o.rotate(Math.PI);
                        break;
                    case 4: o.translate(0, n), o.scale(1, -1);
                        break;
                    case 5: o.rotate(.5*Math.PI), o.scale(1, -1);
                        break;
                    case 6: o.rotate(.5*Math.PI), o.translate(0, -n);
                        break;
                    case 7: o.rotate(.5*Math.PI), o.translate(r, -n), o.scale(-1, 1);
                        break;
                    case 8: o.rotate(-.5*Math.PI), o.translate(-r, 0)
                }
            }
                , e.getTransformedOptions=function(t, i, a) {
                var r, n, s=o.call(e, t, i), l=s.orientation;
                if(l===!0&&a&&a.exif&&(l=a.exif.get("Orientation")), !l||l>8||1===l)return s;
                r= {}
                ;
                for(n in s)s.hasOwnProperty(n)&&(r[n]=s[n]);
                switch(r.orientation=l, l) {
                    case 2: r.left=s.right, r.right=s.left;
                        break;
                    case 3: r.left=s.right, r.top=s.bottom, r.right=s.left, r.bottom=s.top;
                        break;
                    case 4: r.top=s.bottom, r.bottom=s.top;
                        break;
                    case 5: r.left=s.top, r.top=s.left, r.right=s.bottom, r.bottom=s.right;
                        break;
                    case 6: r.left=s.top, r.top=s.right, r.right=s.bottom, r.bottom=s.left;
                        break;
                    case 7: r.left=s.bottom, r.top=s.right, r.right=s.top, r.bottom=s.left;
                        break;
                    case 8: r.left=s.bottom, r.top=s.left, r.right=s.top, r.bottom=s.right
                }
                return r.orientation>4&&(r.maxWidth=s.maxHeight, r.maxHeight=s.maxWidth, r.minWidth=s.minHeight, r.minHeight=s.minWidth, r.sourceWidth=s.sourceHeight, r.sourceHeight=s.sourceWidth), r
            }
        }

    );
//# sourceMappingURL=load-image.all.min.js.map