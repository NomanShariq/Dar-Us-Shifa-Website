/**
 * Jgallery 1.0.0
 */

(function () {
    'use strict';



    var defaultOptionsTpl = {
        animate                    : true,
        layout                     : 'justified',
        filter                     : '*',
        filterControls             : '',
        autoConsiderScrollBars     : true,
        onBeforeOptionsChanged     : function () {},
        onOptionsChanged           : function () {},
        onBeforeRender             : function () {},
        onRender                   : function () {},
        autoInitOnDomReady         : true,
        autoInitOnDomMutation      : true,
        autoSyncChildListMutation  : true,
        useOptionAttributes        : true,
        autoSyncAttributesMutation : true,
        autoSyncChildClassMutation : true
    };

    var defaultOptionsLayoutTpl = {};

    var defaultOptionsCompleted = null;

    var idAutoIncrement = 0;

    var lazyLoadImagesQueue = null;

    var helper = {
        isTruly: function (i) {
            return !!i && (typeof i !== 'string' || i.toLowerCase() !== 'false');
        },
        expectArray: function (i) {
            return helper.isArrayLike(i) ? i : [i];
        },
        isArrayLike: function (i) {
            return i.length === +i.length && typeof i !== 'string';
        },
        inArray: function (arr, elt) {
            return arr.indexOf(elt) !== -1;
        },
        objectWalk: function (obj, func) {
            var a;
            func(obj);
            if (typeof obj === 'object') {
                for (a in obj) {
                    helper.objectWalk(obj[a], func);
                }
            }
        },
        objectAssign: function (target) {
            var pos,
                name;
            for (pos = 1; pos < arguments.length; pos++) {
                for (name in arguments[pos]) {
                    target[name] = arguments[pos][name];
                }
            }
            return target;
        },
        optionsMerge: function (target, add) {
            var name;
            for (name in add) {
                if (typeof target[name] !== 'undefined') {
                    target[name] = add[name];
                }
            }
            return target;
        },
        isValidCssSelector: function (selector) {
            var result = false;
            if (typeof selector === 'string') {
                try {
                    helper.matches(document.body, selector);
                    result = true;
                } catch (e) {}
            }
            return result;
        },
        matches: Element.prototype.matches ? function (element, selector) {
            return element.matches(selector);
        } : (Element.prototype.msMatchesSelector ? function (element, selector) {
            return element.msMatchesSelector(selector);
        } : (Element.prototype.webkitMatchesSelector ? function (element, selector) {
            return element.webkitMatchesSelector(selector);
        } : function (element, selector) {
            var matches = (element.document || element.ownerDocument).querySelectorAll(selector),
                i = matches.length;
            while (--i >= 0 && matches.item(i) !== element) {}
            return i > -1;
        })),
        changeMultipleClassNames: (function () { // IE11 support for adding multiple css classes
            var list = document.createElement('div').classList;
            list.add('a', 'b');
            return list.contains('b');
        })() ? function (element, add, classNames) {
            element.classList[add ? 'add' : 'remove'].apply(element.classList, classNames);
        } : function (element, add, classNames) {
            var length = classNames.length,
                change = add ? 'add' : 'remove',
                pos = length;
            while (pos--) {
                element.classList[change](classNames[length - pos - 1]);
            }
        },
        expectNaturalImageSize: (function () {
            var interval, images = [], update;

            update = function () {
                var a;
                for (a = 0; a < images.length; a++) {
                    if (images[a].img.naturalWidth && images[a].img.naturalHeight || images[a].ready) {
                        images[a].callback(images[a].img, !images[a].error);
                        images.splice(a, 1);
                        a--;
                    }
                }

                if (!images.length) {
                    clearInterval(interval);
                    interval = null;
                }
            };

            return function (img, onReadyCallback) {
                var obj = {
                    img: img,
                    callback: onReadyCallback || function () {
                    },
                    imgB: document.createElement('img'),
                    ready: false,
                    error: false
                };

                obj.imgB.addEventListener('load', function () {
                    obj.ready = true;
                }, false);
                obj.imgB.addEventListener('error', function () {
                    obj.ready = true;
                    obj.error = true;
                }, false);
                obj.imgB.src = obj.img.src;

                images.push(obj);
                if (!interval) interval = setInterval(update, 0);
            };
        })(),
        processLazyLoading: function () {
            if (lazyLoadImagesQueue === null) {
                return;
            }

            // temporarily disable observations
            pauseMutationObservation();

            var pos = lazyLoadImagesQueue.length,
                viewportWidth = Math.max(document.documentElement.clientWidth, window.innerWidth || 0),
                viewportHeight = Math.max(document.documentElement.clientHeight, window.innerHeight || 0),
                imagesToLoad = [],
                rect,
                xPos,
                yPos,
                edge = 1.5; // 1 is exactly the viewport size; 2 is the space of one viewport more in each direction and so on

            while (pos--) {
                rect = lazyLoadImagesQueue[pos].image.getBoundingClientRect();

                // calculate visibility of the image - the values will be between 0 and 1 if the image is visible
                xPos = rect.right / (viewportWidth + (rect.right - rect.left));
                yPos = rect.bottom / (viewportHeight + (rect.bottom - rect.top));

                if (xPos > 1 - edge && xPos < edge && yPos > 1 - edge && yPos < edge) {
                    imagesToLoad.push(lazyLoadImagesQueue.splice(pos, 1)[0]);
                }
            }

            // start loading images
            // we use "for" instead of "while", because we need the correct order. (The loading order should be from top to bottom)
            for (pos = 0; pos < imagesToLoad.length; pos++) {
                imagesToLoad[pos].item.contentElement.classList.add('jgalleryItemLoading');
                if (imagesToLoad[pos].src) {
                    imagesToLoad[pos].image.src = imagesToLoad[pos].src;
                }
                if (imagesToLoad[pos].srcset) {
                    imagesToLoad[pos].image.srcset = imagesToLoad[pos].srcset;
                }
            }
        },
        registerReadOnlyObjectParameters: function (obj, parameters) {
            var key;
            for (key in parameters) {
                Object.defineProperty(obj, key, {
                    value: parameters[key],
                    enumerable: true
                });
            }
        },
        completeDefaultOptionsObject: function () {
            if (defaultOptionsCompleted !== Jgallery._defaultOptions.layout && typeof Jgallery._layouts[Jgallery._defaultOptions.layout] !== 'undefined') {
                Jgallery._defaultOptions = helper.optionsMerge(helper.cloneDefaultOptionsTemplate(Jgallery._defaultOptions.layout), Jgallery._defaultOptions);
                defaultOptionsCompleted = Jgallery._defaultOptions.layout;
            }
        },
        cloneDefaultOptionsTemplate: function (layout) {
            if (typeof defaultOptionsLayoutTpl[layout] === 'undefined' && typeof Jgallery._layouts[layout] !== 'undefined') {
                defaultOptionsLayoutTpl[layout] = helper.objectAssign({}, Jgallery._layouts[layout]._defaultOptions, defaultOptionsTpl);
            }
            return typeof defaultOptionsLayoutTpl[layout] !== 'undefined' ? helper.objectAssign({}, defaultOptionsLayoutTpl[layout]) : {};
        }
    };

    var mutationObservation = true;

    function pauseMutationObservation () {
        mutationObservation = false;
        setTimeout(function() {
            mutationObservation = true;
        }, 0);
    }

    var initMutationObserver = new function() {
        var active = false;
        var mutationObserver = new MutationObserver(function () {
            if (mutationObservation) {
                initAll();
            }
        });

        this.reset = function () {
            var value = Jgallery._defaultOptions.autoInitOnDomMutation;
            if (active !== !!value) {
                if (value) {
                    initAll();
                    mutationObserver.observe(document.body, {
                        attributes      : true,
                        attributeFilter : ['class'],
                        subtree         : true,
                        childList       : true
                    });
                } else {
                    mutationObserver.disconnect();
                }
                active = !!value;
            }
        };
    };

    function JgalleryRenderObject(jgalleryInstance) {
        var style = getComputedStyle(jgalleryInstance.element),
            dimensions = {
                actualBox: null,
                borderBox: {
                    width  : jgalleryInstance.element.offsetWidth,
                    height : jgalleryInstance.element.offsetHeight
                },
                paddingBox: {
                    width  : jgalleryInstance.element.clientWidth,
                    height : jgalleryInstance.element.clientHeight
                },
                contentBox: null,
                border: {
                    top    : parseInt(style.borderTopWidth),
                    right  : parseInt(style.borderRightWidth),
                    bottom : parseInt(style.borderBottomWidth),
                    left   : parseInt(style.borderLeftWidth)
                },
                padding: {
                    top    : parseInt(style.paddingTop),
                    right  : parseInt(style.paddingRight),
                    bottom : parseInt(style.paddingBottom),
                    left   : parseInt(style.paddingLeft)
                }
            };
        dimensions.contentBox = {
            width: dimensions.paddingBox.width - dimensions.padding.left - dimensions.padding.right,
            height: dimensions.paddingBox.height - dimensions.padding.top - dimensions.padding.bottom
        };
        dimensions.actualBox = style.boxSizing === 'border-box' ? dimensions.borderBox : dimensions.contentBox;

        helper.registerReadOnlyObjectParameters(this, {
            jgalleryInstance : jgalleryInstance,
            dimensions       : dimensions,
            items            : [],
            layoutStorage    : jgalleryInstance._layoutStorage
        });
        this.styleToApply = '';

        var pos = jgalleryInstance._allItems.length;
        while (pos--) {
            this.items.unshift(new JgalleryRenderObjectItem(jgalleryInstance._allItems[pos]));
        }
    }

    function JgalleryRenderObjectItem(item) {
        helper.registerReadOnlyObjectParameters(this, {
            element       : item.contentElement,
            valid         : item.valid,
            imageError    : item.failures,
            matchFilter   : item.matchFilter,
            width         : item.size[0],
            height        : item.size[1],
            aspectRatio   : item.ratio,
            layoutStorage : item.layoutStorage
        });
        this.visible = item.visible;
        this.styleToApply = '';
    }

    window.JgalleryLayout = function (parameter) {
        if (typeof parameter.name === 'string' && typeof Jgallery._layouts[parameter.name] === 'undefined') {
            this.name                         = parameter.name;
            this._defaultOptions              = parameter && typeof parameter.options === 'object' ? parameter.options : {};
            this._handler                     = parameter && typeof parameter.handler === 'function' ? parameter.handler : function() {};
            Jgallery._layouts[parameter.name] = this;
        }
    };

    JgalleryLayout.prototype = {
        constructor: JgalleryLayout,
        set handler(value) { },
        get handler() {
            return this._handler;
        }
    };

    window.Jgallery = function (element, options) {
        var isNewInstance = typeof element.jgallery === 'undefined',
            self = isNewInstance ? this : element.jgallery,
            visibilityClassName,
            prevContainerWidth = 0;

        options = options || {};

        // initialize default options
        self._options = Jgallery.getDefaultOptions();

        // merge options from element and options object
        if (helper.objectAssign({}, self._options, options).useOptionAttributes) {
            options = helper.objectAssign({}, self._getOptionParametersFromElement(element), options);
        }

        if (isNewInstance) {

            // bind instance to container element
            element.jgallery = self;

            // register several parameters
            helper.registerReadOnlyObjectParameters(self, {
                element         : element,
                id              : ++idAutoIncrement,
                _allItems       : [],
                _layoutStorage  : {},
                _filterControls : [],
                _itemVisibilityClasses: {
                    null_true: {
                        add: ['jgalleryItemInitialToVisible'],
                        remove: []
                    },
                    null_false: {
                        add: ['jgalleryItemHidden'],
                        remove: []
                    },
                    false_true: {
                        add: ['jgalleryItemHiddenToVisible'],
                        remove: []
                    },
                    true_false: {
                        add: ['jgalleryItemVisibleToHidden'],
                        remove: []
                    },
                    true_true: {
                        add: ['jgalleryItemVisibleToVisible'],
                        remove: []
                    },
                    true: {
                        add: ['jgalleryItemVisible'],
                        remove: []
                    },
                    false: {
                        add: ['jgalleryItemHidden'],
                        remove: []
                    },
                    null: {
                        add: [],
                        remove: []
                    }
                },
                _itemVisibilityClassesArray: [],
                _insertQueue: {
                    maxQueueTime : 1000,
                    maxQuietTime : 400,
                    items        : [],
                    lastProcess  : null,
                    timer        : null
                },
                _elementMutationObserverConfig: {
                    attributes: false,
                    childList: false
                },
                _elementMutationObserver: new MutationObserver(function(mutations) {
                    if (mutationObservation) {
                        var options = {},
                            setOptions = false,
                            render = false,
                            syncElements = false;
                        mutations.forEach(function(mutation) {
                            switch (mutation.type) {
                                case 'attributes':
                                    if (mutation.attributeName === 'class' && self._options.useOptionAttributes) {
                                        if (self._options.animate !== mutation.target.classList.contains('jgalleryAnimated') && typeof options.animate === 'undefined') {
                                            options.animate = !self._options.animate;
                                            setOptions = true;
                                        }
                                    }
                                    else if (mutation.attributeName === 'style') {
                                        render = true;
                                    }
                                    else if (mutation.attributeName.indexOf('data-jgallery-') === 0 && self._options.useOptionAttributes) {
                                        var optionData = self._getOptionParametersFromElement(null, null, mutation.attributeName);
                                        options[optionData.name] = optionData.value;
                                        setOptions = true;
                                    }
                                    break;
                                case 'childList':
                                    syncElements = true;
                                    render = true;
                                    break;
                            }
                        });
                        if (syncElements) {
                            self._syncElements();
                        }
                        if (setOptions) {
                            self.setOptions(options);
                        } else if (render) {
                            self.render();
                        }
                    }
                }),
                _childMutationObserverConfig: {
                    attributes: false,
                    attributeFilter: ["class"]
                },
                _childMutationObserver: new MutationObserver(function(mutations) {
                    if (mutationObservation) {
                        var filter = self._options.filter,
                            render = false;
                        mutations.forEach(function(mutation) {
                            switch (mutation.type) {
                                case 'attributes':
                                    if (typeof mutation.target.jgalleryItem !== 'undefined') {
                                        if (self._setMatchFilter(mutation.target.jgalleryItem, filter)) {
                                            render = true;
                                        }
                                    }
                            }
                        });
                        if (render) {
                            self.render();
                        }
                    }
                })
            });
            self._itemIdAutoIncrement = 0;

            // fill _itemVisibilityClassesArray
            helper.objectWalk(self._itemVisibilityClasses, function(obj) {
                if (typeof obj === 'string' && self._itemVisibilityClassesArray.indexOf(obj) === -1) {
                    self._itemVisibilityClassesArray.push(obj);
                }
            });

            // set remove arrays of _itemVisibilityClasses
            for (visibilityClassName in self._itemVisibilityClasses) {
                self._itemVisibilityClasses[visibilityClassName].remove = self._itemVisibilityClassesArray.filter(function (el) {
                    return self._itemVisibilityClasses[visibilityClassName].add.indexOf(el) < 0;
                });
            }

            // initialize user specific options
            self._updateOptionParameters(options);

            // temporarily disable observations
            pauseMutationObservation();

            // set jgallery id as element attributes (so it's easy recognizable outside)
            self.element.setAttribute('data-jgalleryid', self.id);

            // initialize animationend event listener
            self.element.addEventListener("animationend", function (event) {
                if (event.target.jgalleryItem) {
                    // temporarily disable observations
                    pauseMutationObservation();

                    helper.changeMultipleClassNames(event.target, true, self._itemVisibilityClasses[JSON.stringify(event.target.jgalleryItem.visible)].add);
                    helper.changeMultipleClassNames(event.target, false, self._itemVisibilityClasses[JSON.stringify(event.target.jgalleryItem.visible)].remove);
                }
            });

            // initialize child elements
            self._syncElements();

            // force rendering on window resize
            prevContainerWidth = self.element.clientWidth;
            window.addEventListener('resize', function () {
                if (self.element.clientWidth !== prevContainerWidth) {
                    prevContainerWidth = self.element.clientWidth;
                    self.render();
                }
            }, false);

            // to permit css hover state on mobile devices
            document.addEventListener("touchstart", function(){}, true);
        } else {
            self.setOptions(options);
        }

        return self;
    };

    Jgallery._layouts = {};
    Jgallery._defaultOptions = helper.objectAssign({}, defaultOptionsTpl);

    Jgallery.setDefaultOptions = function (options) {
        if (typeof options.layout !== 'undefined' && Jgallery._defaultOptions.layout !== options.layout && typeof Jgallery._layouts[options.layout] !== 'undefined') {
            Jgallery._defaultOptions.layout = options.layout;
        }
        helper.completeDefaultOptionsObject();
        Jgallery._defaultOptions = helper.optionsMerge(Jgallery._defaultOptions, options);
        initMutationObserver.reset();
    };

    Jgallery.getDefaultOptions = function (layout) {
        if (layout && layout !== Jgallery._defaultOptions.layout && typeof Jgallery._layouts[layout] !== 'undefiend') {
            return helper.optionsMerge(helper.cloneDefaultOptionsTemplate(layout), Jgallery._defaultOptions);
        } else {
            helper.completeDefaultOptionsObject();
            return helper.objectAssign({}, Jgallery._defaultOptions);
        }
    };

    Jgallery.getDefaultOption = function (name) {
        helper.completeDefaultOptionsObject();
        return typeof Jgallery._defaultOptions[name] !== 'undefined' ? Jgallery._defaultOptions[name] : null;
    };


    Jgallery.prototype = {
        IMG_FAILURE: 0,
        IMG_LOADING: 1,
        IMG_LOADING_READY: 2, // the image is loading but we have width and height attributes for calculation
        IMG_READY: 3, // the image is still loading but we have naturalWidth and naturalHeight for calculation
        IMG_FINISHED: 4,

        ITEM_REGISTERED: 1,
        ITEM_INSERT_QUEUE: 2,
        ITEM_INSERTED: 3,

        setOptions: function (options) {
            this._updateOptionParameters(options);
            this.render();
            helper.processLazyLoading();
        },
        getOptions: function () {
            return helper.objectAssign({}, this._options);
        },
        getOption: function (optionName) {
            return typeof this._options[optionName] !== 'undefined' ? this._options[optionName] : null;
        },
        syncAttributes: function () {
            if (this._options.useOptionAttributes) {
                this.setOptions(this._getOptionParametersFromElement());
            }
        },
        syncChildList: function () {
            this._syncElements();
            this.render();
        },
        render: function () {
            var pos,
                item,
                itemStyle,
                changeClasses,
                renderObject = this._getRenderObject(),
                filter = this._options.filter;

            // execute user defined call back function
            this._options.onBeforeRender(this);

            // temporarily disable observations
            pauseMutationObservation();

            // preset all new values to the style attribute of hidden item elements (to start animations from there)
            pos = renderObject.items.length;
            while (pos--) {
                item = renderObject.items[pos];

                if (item.valid && !item.element.jgalleryItem.visible) {
                    item.element.style.cssText = item.element.style.cssText + '; ' + item.styleToApply + '; transition: none; ';
                }
            }

            // force painting
            document.body.offsetWidth;

            // set container element style
            renderObject.jgalleryInstance.element.style.cssText = renderObject.jgalleryInstance.element.style.cssText + '; ' + renderObject.styleToApply;

            // set all new values to the style attribute and to the class attribute of item elements
            pos = renderObject.items.length;
            while (pos--) {
                item = renderObject.items[pos];

                if (item.valid) {
                    if (item.element.jgalleryItem.visible) {
                        item.element.style.cssText = item.element.style.cssText + '; ' + item.styleToApply;
                    } else {
                        item.element.style.transition = '';
                    }

                    changeClasses = this._itemVisibilityClasses[JSON.stringify(item.element.jgalleryItem.visible) + '_' + JSON.stringify(item.visible)];
                    if (changeClasses) {
                        helper.changeMultipleClassNames(item.element, true, changeClasses.add || []);
                        helper.changeMultipleClassNames(item.element, false, changeClasses.remove || []);
                    }
                    item.element.jgalleryItem.visible = item.visible;
                }
            }

            // reset matchFilter attribute
            // set class attribute of item elements which have no animation
            pos = renderObject.items.length;
            while (pos--) {
                item = renderObject.items[pos];

                if (item.valid) {
                    this._setMatchFilter(item.element.jgalleryItem, filter);

                    itemStyle = getComputedStyle(item.element);
                    if (itemStyle.animationName === 'none') {
                        changeClasses = this._itemVisibilityClasses[JSON.stringify(item.visible)];
                        helper.changeMultipleClassNames(item.element, true, changeClasses.add || []);
                        helper.changeMultipleClassNames(item.element, false, changeClasses.remove || []);
                    }
                }
            }

            // execute user defined call back function
            this._options.onRender(this);
        },
        _resetElementMutationObserver: function () {
            var config = this._elementMutationObserverConfig,
                changed = false,
                observed = config.attributes || config.childList,
                observe;

            if (config.attributes !== this._options.autoSyncAttributesMutation) {
                config.attributes = !config.attributes;
                changed = true;
            }
            if (config.childList !== this._options.autoSyncChildListMutation) {
                config.childList = !config.childList;
                changed = true;
            }
            observe = config.attributes || config.childList;
            if (changed) {
                if (observed) {
                    this._elementMutationObserver.disconnect();
                }
                if (observe) {
                    this._elementMutationObserver.observe(this.element, helper.objectAssign({}, config));
                }
            }
        },
        _resetChildMutationObserver: function (force) {
            var config 	 = this._childMutationObserverConfig,
                configCopy,
                changed  = false,
                observed = config.attributes,
                observe,
                item,
                filter,
                render   = false,
                pos;

            if (config.attributes !== this._options.autoSyncChildClassMutation) {
                config.attributes = !config.attributes;
                changed = true;
            }
            observe = config.attributes;
            if (changed || force) {
                if (observed) {
                    this._childMutationObserver.disconnect();
                }
                if (observe) {
                    configCopy = helper.objectAssign({}, config);
                    filter = this._options.filter;
                    pos = this._allItems.length;
                    while (pos--) {
                        item = this._allItems[pos];
                        this._childMutationObserver.observe(item.contentElement, configCopy);
                        if (this._setMatchFilter(item, filter)) {
                            render = true;
                        }
                    }
                }
            }
            if (render) {
                this.render();
            }
        },
        _setMatchFilter: function (item, filter) {
            if (item.status === this.ITEM_INSERTED) {
                var matchFilter = helper.matches(item.contentElement, filter);
                if (matchFilter !== item.matchFilter) {
                    item.matchFilter = matchFilter;
                    return true;
                }
            }
            return false;
        },
        _filterControlEventHandler: function (event) {
            var pos = this._filterControls.length,
                pos2,
                filter = [],
                controlElement,
                targetElement = event.target;

            // get the select element if an option element is clicked
            if (targetElement.nodeName === 'OPTION') {
                targetElement = targetElement.parentNode;
            }

            // collect filter selectors of all control elements
            while (pos--) {
                controlElement = this._filterControls[pos];

                if (targetElement === controlElement) {
                    if (controlElement.nodeName === 'SELECT') {
                        // get filters from selected options of select field
                        pos2 = controlElement.options.length;
                        while (pos2--) {
                            if (controlElement.options[pos2].selected) {
                                filter = filter.concat(controlElement.options[pos2].value);
                            }
                        }
                    }
                    else if (controlElement.checked || controlElement.type !== 'checkbox') {
                        // get filters of focused elements which are not unchecked checkboxes
                        filter = filter.concat(controlElement.value);
                    }
                } else if (controlElement.checked) {
                    if (targetElement.type === 'checkbox' && controlElement.type === 'checkbox') {
                        // get filters from active checkboxes which are not clicked
                        filter = filter.concat(controlElement.value);
                    } else {
                        // uncheck active radio buttons which are not clicked
                        controlElement.checked = false;
                    }
                } else if (controlElement.nodeName === 'SELECT') {
                    // deselect options of select fields which are not clicked
                    pos2 = controlElement.options.length;
                    while (pos2--) {
                        controlElement.options[pos2].selected = false;
                    }
                }
            }

            this.setOptions({filter:(filter.join(', ') || ':not(*)')});
        },
        _getRenderObject: function () {
            var autoConsiderScrollBars = this._options.autoConsiderScrollBars,
                renderObject        = new JgalleryRenderObject(this),
                renderObjectChanged = false,
                ancestor            = renderObject.jgalleryInstance.element,
                ancestorOverflowY   = null,
                ancestorHeight      = null,
                width               = renderObject.jgalleryInstance.element.offsetWidth,
                position            = renderObject.jgalleryInstance.element.style.position,
                style               = renderObject.jgalleryInstance.element.style.cssText,
                newHeight,
                testRequired        = false;

            this._prepareRenderObject(renderObject);

            // test whether we need a recalculation because of appearing or disappearing scrollbars
            if (autoConsiderScrollBars) {

                // test whether we really need an expensive test
                while (ancestor.parentNode && ancestor.parentNode.nodeName !== '#document') {
                    ancestor = ancestor.parentNode;
                    ancestorOverflowY = getComputedStyle(ancestor).overflowY;
                    if (ancestorOverflowY === 'auto' || ancestor.nodeName === 'BODY' && ancestorOverflowY === 'visible') {
                        testRequired = true;

                        ancestorHeight = ancestor.nodeName === 'BODY'
                            ? Math.max(document.documentElement.clientHeight, window.innerHeight || 0)
                            : ancestor.offsetHeight;
                        if (ancestorHeight < renderObject.jgalleryInstance.element.offsetHeight) {
                            newHeight = renderObject.styleToApply.match(/height:\s*([0-9]+)px;/);
                            newHeight = newHeight ? parseInt(newHeight[1]) : null;
                            if (ancestorHeight < newHeight) {
                                testRequired = false;
                            }
                        }

                        break;
                    }
                }

                // if we really need the expensive test let's do it
                if (testRequired) {
                    renderObject.jgalleryInstance.element.style.cssText =
                        style + '; ' +
                        renderObject.styleToApply + '; ' +
                        'transition: none; ' +
                        'animation: none; ' +
                        'overflow: hidden; ';
                    if (width !== renderObject.jgalleryInstance.element.offsetWidth) {
                        renderObject.jgalleryInstance.element.style.position = position;
                        renderObject = new JgalleryRenderObject(this);
                        renderObjectChanged = true;
                    }
                    renderObject.jgalleryInstance.element.style.cssText = style + '; transition: none; animation: none; ';
                    document.body.offsetWidth;
                    renderObject.jgalleryInstance.element.style.cssText = style;
                    document.body.offsetWidth;

                    // if there is a new renderObject let's prepare it
                    if (renderObjectChanged) {
                        this._prepareRenderObject(renderObject);
                    }
                }
            }

            return renderObject;
        },
        _prepareRenderObject: function (renderObject) {

            // insert the new calculated values
            Jgallery._layouts[this._options.layout].handler(renderObject);

            // complete container element style
            if (this.element.children.length && this.element.children[0].offsetParent !== this.element) {
                renderObject.styleToApply += '; position: relative; ';
            }
            if (this.element.style.display !== 'block') {
                renderObject.styleToApply += '; display: block; ';
            }
        },
        _syncElements: function () {
            var children = this.element.children,
                pos,
                item,
                filter = this.getOption('filter');

            // clear items array
            this._allItems.length = 0;

            // rebuild items array
            for (pos = 0; pos < children.length; pos++) {

                if (typeof children[pos].jgalleryItem === 'undefined') {
                    item = this._createItem(children[pos]);
                } else {
                    item = children[pos].jgalleryItem;
                }
                this._setMatchFilter(item, filter);
                this._allItems.push(item);
            }

            this._resetChildMutationObserver(true);
        },
        _createItem: function (contentElement) {

            if (this._insertQueue.items.length === 0) {
                this._insertQueue.lastProcess = (new Date()).getTime();
            }

            // temporarily disable observations
            pauseMutationObservation();

            // remove existing jgallery classes from element
            helper.changeMultipleClassNames(contentElement, false, this._itemVisibilityClassesArray.concat(['jgalleryItem', 'jgalleryItemLoading', 'jgalleryItemInitializing', 'jgalleryItemReady', 'jgalleryItemComplete']));

            // generate and insert the item object
            var item = {
                id             : ++this._itemIdAutoIncrement,
                contentElement : contentElement,
                size           : [0, 0],
                ratio          : 0,
                failures       : false,
                status         : this.ITEM_REGISTERED,
                images         : [],
                imagesStatus   : [],
                imagesInfo     : [],
                matchFilter    : null,
                layoutStorage  : {},
                visible        : null
            };
            contentElement.jgalleryItem = item;

            // set attributes, classes and styles
            item.contentElement.setAttribute('data-jgalleryitemid', item.id);
            item.contentElement.style.visibility = 'hidden';
            item.contentElement.style.position   = 'absolute';
            helper.changeMultipleClassNames(item.contentElement, true, ['jgalleryItem', 'jgalleryItemLoading', 'jgalleryItemInitializing']);

            // search for images to get natural image sizes (they are needed to get the element size)
            var images = contentElement.nodeName === 'IMG' ? [contentElement] : contentElement.querySelectorAll('img'),
                pos = images.length;
            while (pos--) {
                (function (e) {
                    item.images.push(e);

                    var attributeWidth  = e.getAttribute('width');
                    var attributeHeight = e.getAttribute('height');
                    var lazySrc         = e.getAttribute('data-jgallerylazysrc');
                    var lazySrcset      = e.getAttribute('data-jgallerylazysrcset');
                    var src             = e.getAttribute('src');

                    if (!src && (lazySrc || lazySrcset)) {
                        // if there is a data-jgallerylazysrc or a data-jgallerylazysrcset attribute but there is no width or height attribute, we deactivate lazy loading for this image
                        if (!attributeWidth || !attributeHeight) {
                            e.src = lazySrc;
                            e.srcset = lazySrcset;
                            lazySrc = null;
                            lazySrcset = null;
                        } else {
                            // set a transparent pixel as an image if there is no src
                            e.src = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEHAAEALAAAAAABAAEAAAICTAEAOw==';
                        }
                    }

                    item.imagesInfo.push({
                        styleWidth: e.style.width,
                        styleHeight: e.style.height,
                        attributeWidth: attributeWidth,
                        attributeHeight: attributeHeight,
                        lazySrc: lazySrc,
                        lazySrcset: lazySrcset
                    });

                    if (attributeWidth !== null && attributeHeight !== null && parseInt(attributeWidth) > 0 && parseInt(attributeHeight) > 0) {
                        item.imagesStatus.push(this.IMG_LOADING_READY);
                    } else {
                        item.imagesStatus.push(this.IMG_LOADING);
                    }
                }).bind(this)(images[pos]);
            }

            // force painting
            document.body.offsetWidth;

            item.images.forEach(function (image, index) {
                var onLoad = function () {
                    item.imagesStatus[index] = image.naturalWidth ? this.IMG_FINISHED : this.IMG_FAILURE;
                    this._onImageFinished(item);
                }.bind(this);

                var onError = function () {
                    item.imagesStatus[index] = this.IMG_FAILURE;
                    this._onImageFinished(item);
                }.bind(this);

                image.addEventListener('load', onLoad, false);
                image.addEventListener('error', onError, false);

                if (image.complete) {
                    onLoad();
                }

                if (!item.imagesInfo[index].lazySrc && !item.imagesInfo[index].lazySrcset) {
                    helper.expectNaturalImageSize(image, function (img, success) {
                        item.imagesStatus[index] = success && image.naturalWidth ? (image.complete ? this.IMG_FINISHED : this.IMG_READY) : this.IMG_FAILURE;
                        this._onImageReady(item);
                    }.bind(this));
                }
            }.bind(this));

            this._onImageReady(item);
            this._onImageFinished(item);

            return item;
        },
        _processInsertQueue: function (maxQuietTimeReached) {
            var queueItem;
            var maxQueueTimeReached = this._insertQueue.lastProcess < (new Date()).getTime() - this._insertQueue.maxQueueTime;
            var imagesStylesToReset = [];
            var imagesStylesToResetPos;
            var imagesInfo;
            var imagePos;
            var imageStyle;
            var queueItems          = [];
            var queueItemsPos;
            var filter              = this._options.filter;
            var lazyLoadImages      = [];

            if (this._insertQueue.timer !== null) {
                clearTimeout(this._insertQueue.timer);
                this._insertQueue.timer = null;
            }

            if (maxQuietTimeReached || maxQueueTimeReached) {

                // temporarily disable observations
                pauseMutationObservation();

                // insert item elements
                queueItem = this._insertQueue.items.shift();
                while (queueItem) {
                    queueItems.push(queueItem);
                    queueItem = this._insertQueue.items.shift();
                }

                // get images where to set width and height style to force image sizes from attributes
                queueItemsPos = queueItems.length;
                while (queueItemsPos--) {
                    queueItem = queueItems[queueItemsPos];

                    imagePos = queueItem.item.images.length;
                    while (imagePos--) {
                        imagesInfo = queueItem.item.imagesInfo[imagePos];

                        // in some cases google chrome and firefox don't have the correct offset size even though the natural size is known
                        if (!imagesInfo.attributeWidth && queueItem.item.images[imagePos].offsetWidth < 40 && queueItem.item.images[imagePos].naturalWidth) {
                            imagesInfo.attributeWidth = queueItem.item.images[imagePos].naturalWidth;
                        }
                        if (!imagesInfo.attributeHeight && queueItem.item.images[imagePos].offsetHeight < 40 && queueItem.item.images[imagePos].naturalHeight) {
                            imagesInfo.attributeHeight = queueItem.item.images[imagePos].naturalHeight;
                        }

                        if (imagesInfo.attributeWidth || imagesInfo.attributeHeight) {
                            imageStyle = getComputedStyle(queueItem.item.images[imagePos]);

                            if ((parseInt(imageStyle.width) < 40 || imageStyle.width === 'auto' || imagesInfo.lazySrc || imagesInfo.lazySrcset) && imagesInfo.attributeWidth && !imagesInfo.styleWidth) {
                                imagesStylesToReset.push({
                                    image: queueItem.item.images[imagePos],
                                    definition: 'width',
                                    value: imagesInfo.attributeWidth + 'px'
                                });
                            }
                            if ((parseInt(imageStyle.height) < 40 || imageStyle.height === 'auto' || imagesInfo.lazySrc || imagesInfo.lazySrcset) && imagesInfo.attributeHeight && !imagesInfo.styleHeight) {
                                imagesStylesToReset.push({
                                    image: queueItem.item.images[imagePos],
                                    definition: 'height',
                                    value: imagesInfo.attributeHeight + 'px'
                                });
                            }
                        }

                        // get images to lazy load
                        if (imagesInfo.lazySrc || imagesInfo.lazySrcset) {
                            lazyLoadImages.push({
                                item   : queueItem.item,
                                image  : queueItem.item.images[imagePos],
                                src    : imagesInfo.lazySrc,
                                srcset : imagesInfo.lazySrcset
                            });
                        }
                    }
                }

                // set width and height style to force image sizes from attributes
                imagesStylesToResetPos = imagesStylesToReset.length;
                while (imagesStylesToResetPos--) {
                    imagesStylesToReset[imagesStylesToResetPos].image.style[imagesStylesToReset[imagesStylesToResetPos].definition] = imagesStylesToReset[imagesStylesToResetPos].value;

                    // set display to "none" because FF need more than only a browser rerendering to apply the sizes to elements
                    imagesStylesToReset[imagesStylesToResetPos].image.style.display = 'none';
                }

                // force browser rendering and display images again after hiding it because of FF
                document.body.offsetWidth;
                imagesStylesToResetPos = imagesStylesToReset.length;
                while (imagesStylesToResetPos--) {
                    imagesStylesToReset[imagesStylesToResetPos].image.style.display = '';
                }

                // get size of item element
                queueItemsPos = queueItems.length;
                while (queueItemsPos--) {
                    queueItem = queueItems[queueItemsPos];
                    queueItem.item.size = [queueItem.contentElement.offsetWidth, queueItem.contentElement.offsetHeight];
                    queueItem.item.ratio = queueItem.item.size[0] / queueItem.item.size[1];
                }

                // remove width and height style where it was set before getting size of item element
                imagesStylesToResetPos = imagesStylesToReset.length;
                while (imagesStylesToResetPos--) {
                    imagesStylesToReset[imagesStylesToResetPos].image.style[imagesStylesToReset[imagesStylesToResetPos].definition] = '';
                }

                // set styles for item element
                queueItemsPos = queueItems.length;
                while (queueItemsPos--) {
                    queueItem = queueItems[queueItemsPos];
                    queueItem.item.status = this.ITEM_INSERTED;
                    queueItem.item.valid = !!(queueItem.item.size[0] && queueItem.item.size[1]);
                    this._setMatchFilter(queueItem.item, filter);
                    queueItem.item.contentElement.classList.remove('jgalleryItemInitializing');
                    queueItem.item.contentElement.classList.add('jgalleryItemReady');
                }

                // calculate and render layout
                this.render();

                // make item elements visible
                queueItemsPos = queueItems.length;
                while (queueItemsPos--) {
                    queueItem = queueItems[queueItemsPos];
                    queueItem.item.contentElement.style.visibility = '';
                }

                // register lazy loading images
                if (lazyLoadImages.length) {
                    this._addImagesToLazyLoadQueue(lazyLoadImages);
                }

                this._insertQueue.lastProcess = (new Date()).getTime();
            } else {
                this._insertQueue.timer = setTimeout(function () {
                    this._processInsertQueue(true);
                }.bind(this), this._insertQueue.maxQuietTime);
            }
        },
        _addImagesToLazyLoadQueue: function (images) {
            // activate lazy loading if is not already activated
            if (lazyLoadImagesQueue === null && images.length) {
                lazyLoadImagesQueue = [];
                window.addEventListener('resize', helper.processLazyLoading, false);
                window.addEventListener('scroll', helper.processLazyLoading, true);
            }

            // add images to lazy loading queue
            lazyLoadImagesQueue = lazyLoadImagesQueue.concat(images);

            helper.processLazyLoading();
        },
        _addToInsertQueue: function (contentElement, item) {
            this._insertQueue.items.push({contentElement: contentElement, item: item});
            this._processInsertQueue(false);
        },
        _onImageFinished: function (item) {
            var failures = item.failures;

            if (!helper.inArray(item.imagesStatus, this.IMG_LOADING) && !helper.inArray(item.imagesStatus, this.IMG_LOADING_READY) && !helper.inArray(item.imagesStatus, this.IMG_READY)) {

                // temporarily disable observations
                pauseMutationObservation();

                if (helper.inArray(item.imagesStatus, this.IMG_FAILURE)) {
                    item.failures = true;
                }
                if (item.status === this.ITEM_INSERTED && failures !== item.failures) {
                    this.render();
                }

                item.contentElement.classList.remove('jgalleryItemLoading');
                item.contentElement.classList.add('jgalleryItemComplete');
            }
        },
        _onImageReady: function (item) {
            var failures = item.failures;

            // register image loading failures
            item.failures = helper.inArray(item.imagesStatus, this.IMG_FAILURE);

            if (item.status === this.ITEM_INSERTED && failures !== item.failures) {
                this.render();
            }

            // insert the element if the sizes of all contained images are known (because the size is important to calculate the layout)
            if (item.status === this.ITEM_REGISTERED && !helper.inArray(item.imagesStatus, this.IMG_LOADING)) {
                item.status = this.ITEM_INSERT_QUEUE;
                this._addToInsertQueue(item.contentElement, item);
            }
        },
        _getOptionParametersFromElement: function (element, layout, attributeName) {
            var defaultOptions,
                defaultOptionsNormalized = {},
                options = {},
                optionName,
                attributes,
                pos;

            element    = element || this.element;
            layout     = layout || element.getAttribute('data-jgallery-layout') || this._options.layout;
            attributes = element.attributes;

            defaultOptions = Jgallery.getDefaultOptions(layout);

            for (optionName in defaultOptions) {
                defaultOptionsNormalized[optionName.toLowerCase()] = {name: optionName, value: defaultOptions[optionName]};
            }

            if (attributeName) {
                optionName = attributeName.substr(14).toLowerCase();
                if (typeof defaultOptionsNormalized[optionName] !== 'undefined') {
                    options.name = defaultOptionsNormalized[optionName].name;
                    options.value = typeof attributes[attributeName] !== 'undefined' ? attributes[attributeName].value : null;
                }
            } else {
                if (element.classList.contains('jgalleryAnimated')) {
                    options.animate = true;
                }

                pos = attributes.length;
                while (pos--) {
                    if (attributes[pos].name.substr(0, 14) === 'data-jgallery-') {
                        optionName = attributes[pos].name.substr(14).toLowerCase();
                        if (typeof defaultOptionsNormalized[optionName] !== 'undefined') {
                            options[defaultOptionsNormalized[optionName].name] = attributes[pos].value;
                        }
                    }
                }
            }

            return options;
        },
        _updateOptionParameters: function (options) {
            var name,
                layoutChanged = false,
                oldOptions,
                defaultOptions,
                optionParametersFromElement,
                pos,
                value,
                filterControls,
                attributeName;

            options = options || {};

            this._options.onBeforeOptionsChanged(this);

            oldOptions = helper.objectAssign({}, this._options);

            // set layout
            if (typeof options.layout === 'object' && options.layout === null && this._options.layout !== Jgallery._defaultOptions.layout) {
                this._options.layout = Jgallery._defaultOptions.layout;
                layoutChanged = true;
            }
            if (typeof options.layout === 'string' && typeof Jgallery._layouts[options.layout] === 'object' && Jgallery._layouts[options.layout].constructor === JgalleryLayout && this._options.layout !== options.layout) {
                this._options.layout = options.layout;
                layoutChanged = true;
            }

            defaultOptions = Jgallery.getDefaultOptions(this._options.layout);

            // sync layout options if layout has changed
            if (layoutChanged) {
                // remove unused layout options
                for (name in this._options) {
                    if (typeof defaultOptions[name] === 'undefined') {
                        delete this._options[name];
                    }
                }
                // set default layout options
                for (name in defaultOptions) {
                    if (typeof this._options[name] === 'undefined') {
                        this._options[name] = defaultOptions[name];
                    }
                }
                // restore layout options from element attributes
                if (this._options.useOptionAttributes) {
                    optionParametersFromElement = this._getOptionParametersFromElement(null, this._options.layout);
                    for (name in optionParametersFromElement) {
                        if (typeof defaultOptions[name] !== 'undefined' && typeof options[name] === 'undefined' && this._options[name] !== optionParametersFromElement[name]) {
                            options[name] = optionParametersFromElement[name];
                        }
                    }
                }
            }

            // set layout options
            for (name in defaultOptions) {
                if (typeof options[name] !== 'undefined' && options[name] !== null) {
                    switch (typeof defaultOptions[name]) {
                        case 'boolean':
                            this._options[name] = helper.isTruly(options[name]);
                            break;
                        case 'number':
                            this._options[name] = +options[name];
                            break;
                        default:
                            this._options[name] = options[name];
                    }
                }
            }

            // set filter
            if (typeof options.filter === 'string' && this._options.filter !== options.filter && helper.isValidCssSelector(options.filter)) this._options.filter = options.filter;

            // set filterControls
            if (typeof options.filterControls === 'string' && (options.filterControls === '' || helper.isValidCssSelector(options.filterControls))) this._options.filterControls = options.filterControls;

            // set animate
            if (typeof options.animate !== 'undefined' && options.animate !== null) this._options.animate = helper.isTruly(options.animate);

            // set autoConsiderScrollBars
            if (typeof options.autoConsiderScrollBars !== 'undefined' && options.autoConsiderScrollBars !== null) this._options.autoConsiderScrollBars = helper.isTruly(options.autoConsiderScrollBars);

            // set event handlers
            if (typeof options.onBeforeOptionsChanged === 'function') this._options.onBeforeOptionsChanged = options.onBeforeOptionsChanged;
            if (typeof options.onOptionsChanged === 'function') this._options.onOptionsChanged = options.onOptionsChanged;
            if (typeof options.onBeforeRender === 'function') this._options.onBeforeRender = options.onBeforeRender;
            if (typeof options.onRender === 'function') this._options.onRender = options.onRender;

            // set autoSyncChildListMutation
            if (typeof options.autoSyncChildListMutation !== 'undefined' && options.autoSyncChildListMutation !== null) this._options.autoSyncChildListMutation = helper.isTruly(options.autoSyncChildListMutation);

            // set autoSyncAttributesMutation
            if (typeof options.autoSyncAttributesMutation !== 'undefined' && options.autoSyncAttributesMutation !== null) this._options.autoSyncAttributesMutation = helper.isTruly(options.autoSyncAttributesMutation);

            // set autoSyncChildClassMutation
            if (typeof options.autoSyncChildClassMutation !== 'undefined' && options.autoSyncChildClassMutation !== null) this._options.autoSyncChildClassMutation = helper.isTruly(options.autoSyncChildClassMutation);


            // reset options with value null
            for (name in options) {
                if (options[name] === null && typeof defaultOptions[name] !== 'undefined') {
                    this._options[name] = defaultOptions[name];
                }
            }

            // reset matchFilter parameter of items
            if (oldOptions.filter !== this._options.filter) {
                pos = this._allItems.length;
                while (pos--) {
                    this._setMatchFilter(this._allItems[pos], this._options.filter);
                }
            }

            // set event listeners for filterControls
            if (oldOptions.filterControls !== this._options.filterControls || this._options.filterControls && this._filterControls.length === 0) {
                filterControls = [].slice.call(this._options.filterControls ? document.querySelectorAll(this._options.filterControls) : []);

                pos = this._filterControls.length;
                while (pos--) {
                    if (!helper.inArray(filterControls, this._filterControls[pos])) {
                        switch (this._filterControls[pos].nodeName + this._filterControls[pos].type) {
                            case 'SELECT':
                            case 'INPUTcheckbox':
                            case 'INPUTradio':
                                this._filterControls[pos].removeEventListener('change', this._filterControls[pos].jgalleryFilterControlHandler);
                                break;
                            case 'INPUTbutton':
                            case 'INPUTsubmit':
                            case 'BUTTONbutton':
                            case 'BUTTONsubmit':
                            case 'BUTTONreset':
                                this._filterControls[pos].removeEventListener('click', this._filterControls[pos].jgalleryFilterControlHandler);
                                break;
                            default:
                                this._filterControls[pos].removeEventListener('input', this._filterControls[pos].jgalleryFilterControlHandler);
                        }
                        this._filterControls.splice(pos, 1);
                    }
                }
                pos = filterControls.length;
                while (pos--) {
                    if (!helper.inArray(this._filterControls, filterControls[pos])) {
                        filterControls[pos].jgalleryFilterControlHandler = this._filterControlEventHandler.bind(this);
                        switch (filterControls[pos].nodeName + filterControls[pos].type) {
                            case 'SELECT':
                            case 'INPUTcheckbox':
                            case 'INPUTradio':
                                filterControls[pos].addEventListener('change', filterControls[pos].jgalleryFilterControlHandler);
                                break;
                            case 'INPUTbutton':
                            case 'INPUTsubmit':
                            case 'BUTTONbutton':
                            case 'BUTTONsubmit':
                            case 'BUTTONreset':
                                filterControls[pos].addEventListener('click', filterControls[pos].jgalleryFilterControlHandler);
                                break;
                            default:
                                filterControls[pos].addEventListener('input', filterControls[pos].jgalleryFilterControlHandler);
                        }
                        this._filterControls.push(filterControls[pos]);
                    }
                }

            }

            // temporarily disable observations
            pauseMutationObservation();

            // reset element mutation observer to new options
            this._resetElementMutationObserver();

            // update "class" element attribute
            this.element.classList[this._options.animate ? 'add' : 'remove']('jgalleryAnimated');

            // update "data-jgallery-" element attributes
            if (this._options.useOptionAttributes) {
                for (name in this._options) {
                    attributeName = 'data-jgallery-' + name.toLowerCase();
                    value = this._options[name];
                    if (typeof options[name] !== 'undefined' && options[name] === null && this.element.hasAttribute(attributeName)) {
                        this.element.removeAttribute(attributeName);
                    }
                    else if (defaultOptions[name] !== this._options[name] || this.element.hasAttribute(attributeName)) {
                        switch (typeof value) {
                            case 'boolean':
                                value = value ? 'true' : 'false';
                                break;
                            case 'number':
                                value = value + '';
                        }
                        if (typeof value === 'string') {
                            this.element.setAttribute(attributeName, value);
                        }
                    }
                }
            }

            // reset child mutation observer to new options
            this._resetChildMutationObserver();

            this._options.onOptionsChanged(this);
        }
    };

    function initAll() {
        // find all elements with class 'jgallery'
        var elements = document.getElementsByClassName('jgallery'),
            pos = elements.length;

        // initialize them automatically if they aren't yet
        while (pos--) {
            if (typeof elements[pos].jgallery === 'undefined') {
                new Jgallery(elements[pos]);
            }
        }
    }

    // as soon as content is loaded
    document.addEventListener('DOMContentLoaded', function() {
        if (Jgallery._defaultOptions.autoInitOnDomReady) {
            initAll();
        }
        initMutationObserver.reset();
    });

    // if jQuery is available register Jgallery as a plugin
    if (typeof jQuery !== 'undefined' && typeof jQuery.fn !== 'undefined') {
        jQuery.fn.jgallery = function (options) {
            return this.each(function () {
                jQuery(this).data('jgallery', new Jgallery(this, options));
            });
        };
    }

})();

new JgalleryLayout({
    name: 'justified',
    options: {
        itemHeight: 260,
        hideOnMissingImage: true,
        itemGap: 0,
        fillLastRow: true,
        fillSingleRow: true
    },
    handler: function(renderObject) {

        var // get layout options
            itemHeight      	   = parseInt(renderObject.jgalleryInstance.getOption('itemHeight')),
            hideOnMissingImage = !!renderObject.jgalleryInstance.getOption('hideOnMissingImage'),
            itemGap            = parseInt(renderObject.jgalleryInstance.getOption('itemGap')),
            fillLastRow        = !!renderObject.jgalleryInstance.getOption('fillLastRow'),
            fillSingleRow      = !!renderObject.jgalleryInstance.getOption('fillSingleRow'),

            loopPos,
            loopPos2,
            items              = renderObject.items,
            itemsVisible       = [],
            itemsHidden        = [],
            itemsLength,
            item,
            containerWidth     = renderObject.dimensions.contentBox.width,
            optWidthAll        = 0,
            optWidthRow,
            curWidthRow        = 0,
            rows               = [],
            rowsLength,
            row,
            rowLength,
            prevRow,
            displaySizeAllX    = 0,
            displaySizeAllY    = 0,
            containerWidthWithoutSpaces,
            fillRow;

        // get optimal width of all items
        loopPos = items.length;
        while (loopPos--) {
            item = items[loopPos];
            if (item.valid && item.matchFilter && !(hideOnMissingImage && item.imageError)) {
                itemsVisible.unshift(item);
                item.optWidth = itemHeight * item.width / item.height;
                optWidthAll += item.optWidth;
            } else {
                itemsHidden.unshift(item);
            }
        }
        itemsLength = itemsVisible.length;

        // find the optimal length (pixels) of a row
        optWidthRow = fillLastRow ? optWidthAll / (Math.round((optWidthAll + (itemGap * itemsLength)) / (containerWidth + itemGap)) || 1) : containerWidth;

        // attach items to rows
        loopPos = itemsLength;
        while (loopPos--) {
            item = itemsVisible[itemsLength - 1 - loopPos];
            if (curWidthRow + (item.optWidth / 2) > optWidthRow * rows.length) {
                rows.push(row = {
                    displaySizeY: 0,
                    displayPosY: 0,
                    ratioAll: 0,
                    optWidth: 0,
                    items: []
                });
            }
            curWidthRow += item.optWidth;
            row.optWidth += item.optWidth;
            row.ratioAll += item.aspectRatio;
            row.items.push(item);
        }

        // calculate sizes and positions of elements
        renderObject.height = 0;
        rowsLength = rows.length;
        prevRow = null;
        for (loopPos = 0; loopPos < rowsLength; loopPos++) {
            row = rows[loopPos];
            displaySizeAllX = 0;
            displaySizeAllY = 0;
            rowLength = row.items.length;
            containerWidthWithoutSpaces = containerWidth - ((rowLength - 1) * itemGap);
            fillRow = rowsLength === 1 && fillSingleRow || rowsLength > 1 && fillLastRow || loopPos < rowsLength - 1 || row.optWidth >= containerWidthWithoutSpaces;

            for (loopPos2 = 0; loopPos2 < rowLength; loopPos2++) {
                item = row.items[loopPos2];
                item.displayPosX = displaySizeAllX + (loopPos2 * itemGap);

                item.displaySizeX = fillRow ? Math.round((item.aspectRatio / row.ratioAll) * containerWidthWithoutSpaces) : Math.round(item.optWidth);
                displaySizeAllX += item.displaySizeX;

                if (fillRow && loopPos2 === rowLength - 1 && displaySizeAllX !== containerWidthWithoutSpaces) {
                    item.displaySizeX += containerWidthWithoutSpaces - displaySizeAllX;
                }
                displaySizeAllY += item.displaySizeX / item.aspectRatio;
            }

            row.displaySizeY = Math.round(displaySizeAllY / rowLength);
            row.displayPosY = prevRow ? prevRow.displayPosY + prevRow.displaySizeY + itemGap : 0;

            for (loopPos2 = 0; loopPos2 < rowLength; loopPos2++) {
                item = row.items[loopPos2];
                item.displaySizeY = row.displaySizeY;
                item.displayPosY = row.displayPosY;

                // set visible parameter and styles for current item
                item.visible = true;
                item.styleToApply = ''
                    + 'position: absolute; '
                    + 'width: ' + item.displaySizeX + 'px; '
                    + 'height: ' + item.displaySizeY + 'px; '
                    + 'left: ' + (renderObject.dimensions.padding.left + item.displayPosX) + 'px; '
                    + 'top: ' + (renderObject.dimensions.padding.top + item.displayPosY) + 'px; ';
            }

            renderObject.height += row.displaySizeY + (loopPos ? itemGap : 0);
            prevRow = row;
        }

        // set styles for container
        renderObject.styleToApply = 'height: ' + (renderObject.dimensions.actualBox.height - renderObject.dimensions.contentBox.height + renderObject.height) + 'px; ';

        // set visible parameter for elements which get hidden
        loopPos = itemsHidden.length;
        while (loopPos--) {
            itemsHidden[loopPos].visible = false;
        }
    }
});

new JgalleryLayout({
    name: 'masonry',
    options: {
        desiredWidth: 200,
        hideOnMissingImage: true,
        horizontalOrder: false,
        itemGap: 0,
    },
    handler: function(renderObject) {

        var // get layout options
            desiredWidth       = parseInt(renderObject.jgalleryInstance.getOption('itemwidth')),
            hideOnMissingImage = !!renderObject.jgalleryInstance.getOption('hideOnMissingImage'),
            horizontalOrder    = !!renderObject.jgalleryInstance.getOption('horizontalOrder'),
            itemGap            = parseInt(renderObject.jgalleryInstance.getOption('itemgap')),

            columnCount,
            availableContainerWidth,
            usedContainerWidth  = 0,
            columnWidth,
            grid                = [],
            currentColumn,
            largestColumnHeight = 0,
            loopPos,
            loopPos2,
            items               = renderObject.items,
            itemsVisible        = [],
            itemsHidden         = [],
            itemsLength,
            containerWidth      = renderObject.dimensions.contentBox.width,
            item;

        // separate visible versus hidden items
        loopPos = items.length;
        while (loopPos--) {
            item = items[loopPos];
            if (item.valid && item.matchFilter && !(hideOnMissingImage && item.imageError)) {
                itemsVisible.push(item);
            } else {
                itemsHidden.push(item);
            }
        }
        itemsLength = itemsVisible.length;

        // get optimal count of columns
        columnCount = Math.round(containerWidth / desiredWidth) || 1;
        columnCount = columnCount > itemsLength ? itemsLength : columnCount;
        availableContainerWidth = containerWidth - ((columnCount - 1) * itemGap);

        // get width of columns
        loopPos = columnCount;
        while (loopPos--) {
            columnWidth = availableContainerWidth - Math.round(availableContainerWidth * loopPos / columnCount) - usedContainerWidth;
            usedContainerWidth += columnWidth;

            grid.push({
                index: grid.length,
                width: columnWidth,
                left: availableContainerWidth - usedContainerWidth + (loopPos * itemGap),
                height: 0
            });
        }

        //attach items to columns
        loopPos = itemsLength;
        while (loopPos--) {
            // get current column
            if (horizontalOrder) {
                currentColumn = grid[currentColumn && currentColumn.index > 0 ? currentColumn.index - 1 : columnCount - 1];
            } else {
                loopPos2 = columnCount - 1;
                currentColumn = grid[loopPos2];
                while (loopPos2--) {
                    if (grid[loopPos2].height < currentColumn.height - 2) { // minus 2 to prevent to many jumps if there are many images with same size on top
                        currentColumn = grid[loopPos2];
                    }
                }
            }

            // calculate size and position
            item                   = itemsVisible[loopPos];
            item.displaySizeX      = currentColumn.width;
            item.displaySizeY      = Math.round((item.displaySizeX / item.width) * item.height);
            item.displayPosX       = currentColumn.left;
            item.displayPosY       = currentColumn.height + (currentColumn.height ? itemGap : 0);
            currentColumn.height  += item.displaySizeY + (currentColumn.height ? itemGap : 0);

            if (largestColumnHeight < currentColumn.height) {
                largestColumnHeight = currentColumn.height;
            }

            // set visible parameter and styles for current item
            item.visible = true;
            item.styleToApply = ''
                + 'position: absolute; '
                + 'width: ' + item.displaySizeX + 'px; '
                + 'height: '+ item.displaySizeY + 'px; '
                + 'left: '  + (renderObject.dimensions.padding.left + item.displayPosX) + 'px; '
                + 'top: '   + (renderObject.dimensions.padding.top + item.displayPosY) + 'px; ';
        }

        // set styles for container
        renderObject.styleToApply = 'height: ' + (renderObject.dimensions.actualBox.height - renderObject.dimensions.contentBox.height + largestColumnHeight) + 'px; ';

        // set visible parameter for elements which get hidden
        loopPos = itemsHidden.length;
        while (loopPos--) {
            itemsHidden[loopPos].visible = false;
        }
    }
});
